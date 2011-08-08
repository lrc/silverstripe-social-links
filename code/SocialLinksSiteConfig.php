<?php
/**
 * Add some additional site wide configuration options.
 */
class SocialLinksSiteConfig extends DataObjectDecorator {

	/**
	 * Add some database variables
	 *
	 * @return array An array of new static variables for the SiteConfig class
	 */
	function extraStatics() {
		return array(
			'db' => array(
				'SLBlog' => 'Varchar(255)',
				'SLFacebook' => 'Varchar(255)',
                'SLTwitter' => 'Varchar(255)',
                'SLLinkedIn' => 'Varchar(255)',
                'SLYouTube' => 'Varchar(255)'
			)
		);
	}

	/**
	 * Display the additional fields in the admin area.
	 *
	 * @param FieldSet $fields The modified fieldset for site admin area.
	 */
	public function updateCMSFields(FieldSet $fields) {
		$fields->addFieldToTab("Root.SocialLinks", new TextField("SLBlog", "Blog Link"));
		$fields->addFieldToTab("Root.SocialLinks", new TextField("SLFacebook", "Facebook Link"));
		$fields->addFieldToTab("Root.SocialLinks", new TextField("SLTwitter", "Twitter Link"));
		$fields->addFieldToTab("Root.SocialLinks", new TextField("SLLinkedIn", "LinkedIn Link"));
		$fields->addFieldToTab("Root.SocialLinks", new TextField("SLYouTube", "YouTube Link"));
	}
	
	public function SocialLinks() {
		$links = $this->extraStatics();
		$output = new DataObjectSet();
		foreach ($links['db'] as $key=>$link) {
			if ($this->owner->$key) {
				$std = new DataObject();
				$std->Link = $this->owner->$key;
				$std->Type = $key;
				$std->Service = str_replace('SL', '', $key);
				$output->push($std);
			}
		}
		return $output;
	}
}