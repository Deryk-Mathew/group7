<?php

App::uses('Component', 'Controller');

class CommonComponent extends Component{
	
	public function mathsAdd($amount1, $amount2) {
        return $amount1 + $amount2;
    }

	public function mathsSub($amount1, $amount2) {
        return $amount1 - $amount2;    
	}

	public function mathsDiv($amount1, $amount2) {
        return $amount1 / $amount2;    
	}
}