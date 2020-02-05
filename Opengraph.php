<?php
// git init
// git add README.md
// git commit -m "first commit"
// git remote add origin https://github.com/websultan/yii2-opengraph-component.git
// git push -u origin master

/*
 * Name: yii2-opengraph-component
 * Description: The component add OpenGraph microdata
 * Author: Tim
 * E-mail: timtim-work@yandex.ru
 */

namespace websultan\opengraph;

use \Yii;
use \yii\base\Component;
use \yii\helpers\Url;

class Opengraph extends Component {

	/** @var string default image */
	protected $image = '@vendor/websultan/opengraph/opengraph-logo.jpg';

	/** @var string default site name */
	protected $siteName = 'Site name';

	/** @var string default width of image */
	protected $imageWidth = '968';

	/** @var string default height of image */
	protected $imageHeight = '504';


	/**
	 * Создание объекта по ID пользователя
	 * 
	 * @param array $metaTags set meta tags of OpenGraph microdata
	 */
	public function setMeta( $metaTags = [] )
	{
		$pagetitle = Yii::$app->view->title;
		$url = preg_replace('/(.+)\?.*/i', '$1', Url::to('', true) );
		
		$defaultLocale = preg_replace('/\-/', '_', Yii::$app->language);
		$defaultSiteName = $this->siteName;
		$defaultUrl = $url;
		$defaultTitle = $pagetitle;
		$defaultDescription = $pagetitle . ' - ' . $defaultSiteName;
		$defaultImage = Url::to($this->image, true);
		$defaultImageWidth = $this->imageWidth;
		$defaultImageHeight = $this->imageHeight;
		$defaultCard = 'summary';
		$defaultType = 'website';
		
		$allMetas = [
			'og:locale' => $defaultLocale,
			'og:site_name' => $defaultSiteName,
			'og:type' => $defaultType,
			'og:url' => $defaultUrl,
			'og:title' => $defaultTitle,
			'og:description' => $defaultDescription,
			'og:image' => $defaultImage,
			'og:image:secure_url' => $defaultImage,
			'og:image:width' => $defaultImageWidth,
			'og:image:height' => $defaultImageHeight,
			'og:image:alt' => $defaultTitle,
			'twitter:card' => $defaultCard,
			'twitter:title' => $defaultTitle,
			'twitter:description' => $defaultDescription,
			'twitter:image' => $defaultImage,
		];
		
		if ( ! empty($metaTags) ) {
			foreach ($metaTags as $key => $value) {
				if ( 
					strpos($key, 'og') === 0 ||
					strpos($key, 'twitter') === 0
				) {
					$allMetas[$keyName] = $value;
				}
			}
			
			if (array_key_exists('title', $metaTags)) {
				$allMetas['og:title'] = $metaTags['title'];
				$allMetas['twitter:title'] = $metaTags['title'];
			}
			
			if (array_key_exists('description', $metaTags)) {
				$allMetas['og:description'] = $metaTags['description'];
				$allMetas['twitter:description'] = $metaTags['description'];
			}
			
			if (array_key_exists('image', $metaTags)) {
				$allMetas['og:image'] = $metaTags['image'];
				$allMetas['og:image:secure_url'] = $metaTags['image'];
				$allMetas['twitter:image'] = $metaTags['image'];
			}
		}
		
		foreach ($allMetas as $metaKey => $metaValue) {
			
			if (strpos($metaKey, 'og:') !== false) {
				$nameMetaProperty = 'property';
			} else {
				$nameMetaProperty = 'name';
			}
			
			Yii::$app->view->registerMetaTag([$nameMetaProperty => $metaKey, 'content' => $metaValue]);
		}
	}
}