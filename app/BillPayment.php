<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillPayment extends Model
{
    protected $fillable = array('renter_id', 'rent', 'total_payble', 'pay_date', 'paid', 'monthyear');
	protected $table    = 'bill_payments';
    protected $guarded  = ['_token'];

    public static $rules = [
    	'renter_id' =>  'required|exists:renters,id',
    	'rent'  	=>  'required|numeric',
    	'total_payble' 	=> 'required|numeric',
    	'pay_date' 	=> 'required|date_format:Y-m-d',
    	'monthyear' => 'required|date_format:Y-m'
    ];

    public function renter() 
    {
        return $this->belongsTo('App\Renter', 'renter_id');
    } 


    public static function trim_all( $str , $what = NULL , $with = ' ' )
    {
        if( $what === NULL )
        {
            //  Character      Decimal      Use
            //  "\0"            0           Null Character
            //  "\t"            9           Tab
            //  "\n"           10           New line
            //  "\x0B"         11           Vertical Tab
            //  "\r"           13           New Line in Mac
            //  " "            32           Space
           
            $what   = "\\x00-\\x20";    //all white-spaces and control chars
        }
       
        return trim( preg_replace( "/[".$what."]+/" , $with , $str ) , $what );
    }


    public static function number_to_word( $num = '' )
    {
        $num    = ( string ) ( ( int ) $num );
       
        if( ( int ) ( $num ) && ctype_digit( $num ) )
        {
            $words  = array( );
           
            $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );
           
            $list1  = array('','one','two','three','four','five','six','seven',
                'eight','nine','ten','eleven','twelve','thirteen','fourteen',
                'fifteen','sixteen','seventeen','eighteen','nineteen');
           
            $list2  = array('','ten','twenty','thirty','forty','fifty','sixty',
                'seventy','eighty','ninety','hundred');
           
            $list3  = array('','thousand','million','billion','trillion',
                'quadrillion','quintillion','sextillion','septillion',
                'octillion','nonillion','decillion','undecillion',
                'duodecillion','tredecillion','quattuordecillion',
                'quindecillion','sexdecillion','septendecillion',
                'octodecillion','novemdecillion','vigintillion');
           
            $num_length = strlen( $num );
            $levels = ( int ) ( ( $num_length + 2 ) / 3 );
            $max_length = $levels * 3;
            $num    = substr( '00'.$num , -$max_length );
            $num_levels = str_split( $num , 3 );
           
            foreach( $num_levels as $num_part )
            {
                $levels--;
                $hundreds   = ( int ) ( $num_part / 100 );
                $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
                $tens       = ( int ) ( $num_part % 100 );
                $singles    = '';
               
                if( $tens < 20 )
                {
                    $tens   = ( $tens ? ' ' . $list1[$tens] . ' ' : '' );
                }
                else
                {
                    $tens   = ( int ) ( $tens / 10 );
                    $tens   = ' ' . $list2[$tens] . ' ';
                    $singles    = ( int ) ( $num_part % 10 );
                    $singles    = ' ' . $list1[$singles] . ' ';
                }
                $words[]    = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' );
            }
           
            $commas = count( $words );
           
            if( $commas > 1 )
            {
                $commas = $commas - 1;
            }
           
            $words  = implode( ', ' , $words );
           
            //Some Finishing Touch
            //Replacing multiples of spaces with one space


            $words  = trim( str_replace( ' ,' , ',' , BillPayment::trim_all( ucwords( $words ) ) ) , ', ' );
            if( $commas )
            {
                $words  = str_replace_last( ',' , ' and' , $words );
            }
           
            return $words;
        }
        else if( ! ( ( int ) $num ) )
        {
            return 'Zero';
        }
        return '';
    }

}
