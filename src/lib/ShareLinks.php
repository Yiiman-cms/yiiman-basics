<?php
	
	namespace YiiMan\YiiBasics\lib;
	
	
	use function urlencode;
	
	/**
	 * Class ShareLinks
	 * @package YiiMan\YiiBasics\lib
	 */
	class ShareLinks {
		private $link ;
		public $body , $title , $image;
		private $isOK;
		public function __construct()
        {
            $this->link=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            if (!empty($_SERVER['QUERY_STRING'])){
                $this->link .='?'.$_SERVER['QUERY_STRING'];
            }
        }

        public function emailTo() {
			$this->parse();
			
			return 'mailto:?subject=' . $this->title . '&body=' . $this->body;
		}
		
		public function everNote() {
			$this->parse();
			
			return 'https://www.evernote.com/clip.action?url=http%3A%2F%2FYiiMan.ir&title=title&body=text';
		}
		
		public function faceBook() {
			$this->parse();
			
			return 'https://www.facebook.com/sharer/sharer.php?display=popup&redirect_uri=http%3A%2F%2Fwww.facebook.com&u=' . $this->link . '&t=' . $this->title;
		}
		
		public function linkedIn() {
			$this->parse();
			
			return 'https://www.linkedin.com/shareArticle?mini=1&url=' . $this->link . '&title=' . $this->title . '&summary=' . $this->body;
		}
		
		
		public function pintrest() {
			$this->parse();
			
			return 'https://www.pinterest.com/pin/create/button/?url=' . $this->link . '&description=' . $this->title . '&media=' . $this->image;
		}
		
		public function pocket() {
			$this->parse();
			
			return 'https://getpocket.com/edit?url=' . $this->link;
		}
		
		public function telegram() {
			$this->parse();
			
			return 'tg://msg?text=' . $this->title . '+' . $this->link;
		}
		
		public function thumbler() {
			$this->parse();
			
			return 'https://www.tumblr.com/share?v=3&u=' . $this->link . '&t=' . $this->title;
		}
		
		public function twitter() {
			$this->parse();
			
			return 'https://twitter.com/intent/tweet?text=' . $this->title . '&url=' . $this->link;
		}
		
		public function whatsApp() {
			$this->parse();
			
			return 'whatsapp://send?text=' . $this->title . '+' . $this->link;
		}
		
		public function metaTag() {
			return '
				<meta name="title" content="'.$this->title.'">
				<meta name="description" content="'.$this->body.'">
				<link rel="image_src" href="'.$this->image.'">
				
				
				<meta property="og:type" content="website">
				<meta property="og:title" content="'.$this->title.'">
				<meta property="og:url" content="'.$this->link.'">
				<meta property="og:description" content="'.$this->body.'">
				<meta property="og:image" content="'.$this->image.'">
				
				
				<meta name="twitter:title" content="'.$this->title.'">
				<meta name="twitter:description" content="'.$this->body.'">
				<meta name="twitter:site" content="twitteruser">
				<meta name="twitter:card" content="summary_large_image">
				<meta name="twitter:image" content="'.$this->image.'">
				
				<meta itemprop="name" content="'.$this->title.'">
				<meta itemprop="description" content="'.$this->body.'">
				
			';
		}
		
		private function parse() {
			if ( empty( $this->isOK ) ) {
				$this->body  = urlencode( $this->body );
				$this->title = urlencode( $this->title );
				$this->link  = urlencode( $this->link );
				$this->image = urlencode( $this->image );
				$this->isOK  = 'ok';
			}
		}
	}
