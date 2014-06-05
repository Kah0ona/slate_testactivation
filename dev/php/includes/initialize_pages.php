<?php 


class SiteInitializer {
	protected $siteName;
	protected $address;
	protected $phone;
	protected $email;
	function __construct($name, $address, $phone, $email){
		$this->siteName = $name;
		$this->address = $address;
		$this->phone = $phone;
		$this->email = $email;
	}	

	public function initializeAll(){
		$pages = array(
			'home'=>'Home',
			'app'=>'App',
			'contact'=>'Contact'
		);
		$this->createPages();
		$this->populateMainMenu($pages);
		$this->setHomepageAndBlogPage();
		$this->populateFooterMenu();
		$this->createFooterAddressWidget();
		$this->createDefaultUsers();
		$this->activatePlugins();
		$this->createLGSubdomain();
		$this->createContactForm();
	}


	public function createPages(){
		$this->createPage('Home', 'home', 'Homepage', 'template-home.php');
		$this->createPage('Contact', 'contact', 'Contact', 'template-contact.php');
		$this->createPage('App', 'app', 'App', 'template-app.php');
		$this->createPage('Nieuws', 'nieuws', '', '');
	}
	
	private function get_page_by_name($pagename){
		$pages = get_pages(array(
			'post_type'=>'page'
		));

		foreach ($pages as $page) 
			if ($page->post_name == $pagename) 
				return $page;

		return false;
	}

	/** 
	 * Creates page if not exists by slug 
	 */
	public function createPage($title, $slug, $content, $template = ''){
		$p = $this->get_page_by_name($slug);
		if(!$p) { //doesnt exist yet
			$page = array(
				  'comment_status' => 'closed',
				  'ping_status' => 'closed',
				  'post_content' => $content,
				  'post_name' => $slug,
				  'post_status' => 'publish',
				  'post_title' => $title,
				  'post_type' => 'page',
				  'page_template' => $template,
			);  
			
			wp_insert_post($page);
		}
	}

	public function setHomepageAndBlogPage(){
		$home = get_page_by_title( 'Home' );
		update_option( 'page_on_front', $home->ID );
		update_option( 'show_on_front', 'page' );

		$blog = get_page_by_title( 'Nieuws' );
		update_option( 'page_for_posts', $blog->ID );
	}


	public function createFooterAddressWidget(){
		
	}

	public function createDefaultUsers(){

	}


	public function activatePlugins(){

	}

	public function createLGSubdomain(){

	}

	/**
	 * Puts home page, contact page in the main menu
	 * $pages is an assoc array with slugs => title
	 */
	public function populateMainMenu($pages) {
		$menuname = 'hoofdmenu';
		$menulocation = 'main-nav';
		$menu_exists = wp_get_nav_menu_object( $menuname );
		if( !$menu_exists ){
			$menu_id = wp_create_nav_menu($menuname);
			foreach ($pages as $slug=>$title){
				wp_update_nav_menu_item($menu_id, 0, array(
					'menu-item-title' =>  $title,
					'menu-item-classes' => $slug,
					'menu-item-url' =>  '/'.$slug , 
					'menu-item-status' => 'publish'));
			}

			if( !has_nav_menu( $menulocation ) ){
				$locations = get_theme_mod('nav_menu_locations');
				$locations[$menulocation] = $menu_id;
				set_theme_mod( 'nav_menu_locations', $locations );
			}
		}
	}

	/**
	 * Creates an empty footer menu, and sticks it in as widget in the footerbar.
	 */
	public function populateFooterMenu(){
		$menuname = 'footermenu';
		$menulocation = 'sitemap';
		$menu_exists = wp_get_nav_menu_object( $menuname );
		if( !$menu_exists ){
			$menu_id = wp_create_nav_menu($menuname);
			wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title' =>  'Contact',
				'menu-item-classes' => 'contact',
				'menu-item-url' =>  '/contact' , 
				'menu-item-status' => 'publish'));

			if( !has_nav_menu( $menulocation ) ){
				$locations = get_theme_mod('nav_menu_locations');
				$locations[$menulocation] = $menu_id;
				set_theme_mod( 'nav_menu_locations', $locations );
			}
		}

	}

}

$siteIniter = new SiteInitializer("Test bedrijf", "Koninginnegracht 19 2514AB Den Haag", "070-8887037", "marten@lokaalgevonden.nl");
$siteIniter->initializeAll();


?>
