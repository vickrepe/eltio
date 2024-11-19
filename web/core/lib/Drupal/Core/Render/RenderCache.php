<?php

namespace Drupal\Core\Render;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Cache\Context\CacheContextsManager;
use Drupal\Core\Cache\VariationCacheFactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Wraps the caching logic for the render caching system.
 *
 * @internal
 */
class RenderCache implements RenderCacheInterface {

  /**
   * Constructs a new RenderCache object.
   *
   * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
   *   The request stack.
   * @param \Drupal\Core\Cache\VariationCacheFactoryInterface $cacheFactory
   *   The variation cache factory.
   * @param \Drupal\Core\Cache\Context\CacheContextsManager $cacheContextsManager
   *   The cache contexts manager.
   */
  public function __construct(
    protected RequestStack $requestStack,
    protected VariationCacheFactoryInterface $cacheFactory,
    protected CacheContextsManager $cacheContextsManager,
  ) {
  }

  /**
   * {@inheritdoc}
   */
  public function get(array $elements) {
    if (!$this->isElementCacheable($elements)) {
      return FALSE;
    }

    $bin = $elements['#cache']['bin'] ?? 'render';
    if (($cache_bin = $this->cacheFactory->get($bin)) && $cache = $cache_bin->get($elements['#cache']['keys'], CacheableMetadata::createFromRenderArray($elements))) {
      if (!$this->requestStack->getCurrentRequest()->isMethodCacheable()) {
        if (!empty(array_filter($cache->tags, fn (string $tag) => str_starts_with($tag, 'CACHE_MISS_IF_UNCACHEABLE_HTTP_METHOD:')))) {
          return FALSE;
        }
      }
      return $cache->data;
    }
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function set(array &$elements, array $pre_bubbling_elements) {
    // Avoid setting cache items on POST requests, this ensures that cache items
    // with a very low hit rate won't enter the cache. All render elements
    // except forms will still be retrieved from cache when available.
    if (!$this->requestStack->getCurrentRequest()->isMethodCacheable() || !$this->isElementCacheable($elements)) {
      return FALSE;
    }

    $bin = $elements['#cache']['bin'] ?? 'render';
    $cache_bin = $this->cacheFactory->get($bin);
    $data = $this->getCacheableRenderArray($elements);
    $cache_bin->set(
      $elements['#cache']['keys'],
      $data,
      CacheableMetadata::createFromRenderArray($data)->addCacheTags(['rendered']),
      CacheableMetadata::createFromRenderArray($pre_bubbling_elements)
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheableRenderArray(array $elements) {
    $data = [
      '#markup' => $elements['#markup'],
      '#attached' => $elements['#attached'],
      '#cache' => [
        'contexts' => $elements['#cache']['contexts'],
        'tags' => $elements['#cache']['tags'],
        'max-age' => $elements['#cache']['max-age'],
      ],
    ];

    // Preserve cacheable items if specified. If we are preserving any cacheable
    // children of the element, we assume we are only interested in their
    // individual markup and not the parent's one, thus we empty it to minimize
    // the cache entry size.
    if (!empty($elements['#cache_properties']) && is_array($elements['#cache_properties'])) {
      $data['#cache_properties'] = $elements['#cache_properties'];

      // Extract all the cacheable items from the element using cache
      // properties.
      $cacheable_items = array_intersect_key($elements, array_flip($elements['#cache_properties']));
      $cacheable_children = Element::children($cacheable_items);
      if ($cacheable_children) {
        $data['#markup'] = '';
        // Cache only cacheable children's markup.
        foreach ($cacheable_children as $key) {
          // We can assume that #markup is safe at this point.
          $cacheable_items[$key] = ['#markup' => Markup::create($cacheable_items[$key]['#markup'])];
        }
      }
      $data += $cacheable_items;
    }

    $data['#markup'] = Markup::create($data['#markup']);
    return $data;
  }

  /**
   * Checks whether a renderable array can be cached.
   *
   * This allows us to not even have to instantiate the cache backend if a
   * renderable array does not have any cache keys or specifies a zero cache
   * max age.
   *
   * @param array $element
   *   A renderable array.
   *
   * @return bool
   *   Whether the renderable array is cacheable.
   */
  protected function isElementCacheable(array $element) {
    // If the maximum age is zero, then caching is effectively prohibited.
    if (isset($element['#cache']['max-age']) && $element['#cache']['max-age'] === 0) {
      return FALSE;
    }
    return isset($element['#cache']['keys']);
  }

}
