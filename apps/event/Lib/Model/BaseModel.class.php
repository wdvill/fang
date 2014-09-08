<?php
    /**
     * BaseModel 
     * 活动的base类
     *
     * @uses Model
     * @package Model::Mini
     * @version $id$
     */
    class BaseModel extends Model{
        /**
         * mid 
         * 访问者的id
         * @var mixed
         * @access protected
         */
        protected $mid;
        public function setMid( $mid ){
            $this->mid = $mid;
        }

        /**
         * DateToTimeStemp 
         * 时间换算成时间戳返回
         * @param mixed $stime 
         * @param mixed $etime 
         * @access public
         * @return void
         */
        public function DateToTimeStemp( $stime,$etime ) {
            $stime = strval( $stime );
            $etime = strval( $etime );

           //如果输入时间是YYMMDD格式。直接换算成时间戳 
            if( isset( $stime[7] ) && isset( $etime[7] ) ){
                //开始时间
                $syear  = substr( $stime,0,4 );
                $smonth = substr( $stime,4,2 );
                $sday   = substr( $stime,6,2 );
                $stime  = mktime( 0, 0, 0, $smonth,$sday,$syear );

                //结束时间
                $eyear  = substr( $etime,0,4 );
                $emonth = substr( $etime,4,2 );
                $eday   = substr( $etime,6,2 );
                $etime  = mktime( 0, 0, 0, $emonth,$eday,$eyear );

                return array( 'between',array( $stime,$etime ) );
            }

            //如果输入时间是YYYYMM格式
            $start_temp   = $this->paramData( $stime );
            $end_temp     = $this->paramData( $etime );
            $start        = $start_temp[0];
            $end          = $end_temp[1];

            return array( 'between',array( $start,$end ) );
        }
}
