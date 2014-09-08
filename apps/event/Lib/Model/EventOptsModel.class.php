<?php
    /**
     * EventOptsModel 
     * 活动的选项模型
     * @uses BaseModel
     * @package 
      */
    class EventOptsModel extends BaseModel{
        public function getOpts( $optId ){
            $map['id'] = intval($optId);
            return $this->where( $map )->find();
        }
    }
