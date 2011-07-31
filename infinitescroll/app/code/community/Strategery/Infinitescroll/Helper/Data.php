<?php

/**
 * InfiniteScroll - Magento Integration
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0),
 * available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 *
 * @category   Strategery
 * @package    Strategery_Infinitescroll	   
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @copyright  Copyright (c) 2011 Strategery Inc. (http://usestrategery.com)
 * 
 * @author     Gabriel Somoza (me@gabrielsomoza.com)
 * @link       http://gabrielsomoza.com/
 */
class Strategery_Infinitescroll_Helper_Data extends Mage_Core_Helper_Abstract {

    protected $_optionsMap;

    public function __construct() {
        $this->_optionsMap = array(
            'loadMsgSelector' => array('data' => 'selectors/loading', 'type' => 'string'),
            'navSelector' => array('data' => 'selectors/navigation', 'type' => 'string'),
            'nextSelector' => array('data' => 'selectors/next', 'type' => 'string'),
            'itemSelector' => array('data' => 'selectors/items', 'type' => 'string'),
            'debug' => array('data' => 'general/debug', 'type' => 'boolean'),
            'loadingImg' => array('data' => 'design/loading_img', 'type' => 'string'),
            'loadingText' => array('data' => 'design/loading_text', 'type' => 'string'),
            'animate' => array('data' => 'design/animate', 'type' => 'boolean'),
            'extraScrollPx' => array('data' => 'design/extra_scroll_px', 'type' => 'integer'),
            'doneText' => array('data' => 'design/done_text', 'type' => 'string'),
            'bufferPx' => array('data' => 'design/buffer_px', 'type' => 'integer'),
            'callback' => array('data' => 'callbacks/processed_callback', 'type' => 'function'),
        );
    }

    public function getConfigData($node) {
        return Mage::getStoreConfig('infinitescroll/' . $node);
    }

    public function getJsConfig() {
        foreach ($this->_optionsMap as $jsOption => $config) {
            if ($value = $this->getConfigData($config['data'])) {
                switch ($config['type']) {
                    case 'string':
                        $value = '"' . $value . '"'; // wrap in double quotes
                        break;
                    case 'boolean':
                        $value = $value == 1 ? 'true' : 'false';
                        break;
                    default:
                    // nothing
                }
                $result .= "'{$jsOption}': {$value},\n";
            }
        }
        $result .= "'behavior': 'magento'";
        return $result;
    }

}