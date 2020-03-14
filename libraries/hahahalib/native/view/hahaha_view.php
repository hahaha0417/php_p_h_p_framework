<?php

namespace hahahalib;

/*
如需參數設定，則使用Global參數，或自己new一個物件，放入天表，在View裡面使用
如果Render = false;則不處理

// --------------------------------------------------------------------------
注意 : 
// --------------------------------------------------------------------------
require & include基本上差不多，只是require出錯會error，include出錯會繼續執行
https://www.php.net/manual/zh/function.require.php
經測試在loop內重複require，會從檔案載入多次，非常慢，
因此引入phtml的方法，會導致每次require都會去讀檔案，超級慢，因此還是使用class的形式做layout，不然很慢

除非使用Opcache，那他會從記憶體讀，但是他讀進來是Opcode，因此會重複解譯執行，他不是完整的reuse code
經測試，使用Opcache，引入兩個檔案各echo一次，重複100次，就多了1.xms，要是很多行，看起來雖不慢，但還是要要花很多時

多次重複require，會使得我專案變成一定要開Opcache(不然太慢了)，這樣子我就沒有操作空間了
// --------------------------------------------------------------------------
所以，決定採取Instance & function render方式使用，有需要再自己require
// --------------------------------------------------------------------------
// 因為進到到客製化區域，可以比較慢
// 記得一組default
// 參數先走天表
// view分類 

// Widgit 用到才載入
// Plugin 要先決定載入插件(填表)，執行前會先處理對應表，執行時會查表，看有什麼對應天表的，載入，載入有兩個以上，表一樣有兩種，覆蓋或者是不覆蓋，
// 

// 重要 : 先直接渲染，為了不要影響controller，有空寫View先渲染到ob_start，在一次吐出來，
// 寫一個function開關ob_start，View運行過程預設是開，Controller則是關
// 假View class bew後跑class外的程式跑下方程式
*/
class hahaha_view extends \hahaha\hahaha_view_base
{
	use \hahahalib\hahaha_instance_trait;
	
	// --------------------------------------------------------------------------
	// Property
    // --------------------------------------------------------------------------
    // 怕亂就先設好，統一流程中處理，或最後處理
    // 副檔名
    public $Extension = "php";
    // 渲染(處理)
    public $Render = false;
    // 緩衝渲染，預設直接輸出
    public $Buffer = false;
    // 最後處理
    public $Final_Deal = false;
    	
	// --------------------------------------------------------------------------
	// 
	// --------------------------------------------------------------------------
    
	function __construct()
	{

    }
    
 

    // --------------------------------------------------------------------------
	// 設定
	// --------------------------------------------------------------------------

    // --------------------------------------------------------------------------
	// 渲染
	// --------------------------------------------------------------------------
    /*
    $item為
    [
        [object, function name]],
        [object, function name]],
    ]
    */
    public function View($items)
    {
        foreach($items as &$item)
        {
            $item_ = $item[0];
            $function_ = &$item[1];
            // 這找不到會呼叫魔術方法__call
            $item_->$function_($this);
        }
    }

    /*
    會記錄參數的Run，""代表使用舊設定，[]執行
    */
    public function iView($items = [])
    {

    }
    
    /*
    設定Run參數
    []，不動作，拋例外
    */
    public function Set_iView($items = [])
    {

    }

    /*
    執行Run
    */
    public function Run_iView($items)
    {

    }

    /*
    重置Run
    */
    public function Reset_iView($items)
    {

    }

    /*
    callback
    */
    public function Callback($callbacks)
    {

    }

    /*
    會記錄參數的Callback，NULL代表使用舊設定，[]執行
    */
    public function iCallback($callbacks = [])
    {

    }
    
    /*
    設定Callback參數
    []，不動作，拋例外
    */
    public function Set_iCallback($callbacks = [])
    {

    }

    /*
    執行Callback
    */
    public function Run_iCallback($callbacks)
    {

    }

    /*
    重置Callback
    */
    public function Reset_iCallback()
    {

    }

    // --------------------------------------------------------------------------
	// 設定
	// --------------------------------------------------------------------------
    /*
    開始渲染
    會呼叫ob_start()
    */
    public function Start()
    {

    }

    /*
    結束渲染
    會呼叫ob_end()
    */
    public function End()
    {

    }

    // --------------------------------------------------------------------------
	// 直接寫法，如需最後處理，請包在View or Callback裡面，統一動作
	// --------------------------------------------------------------------------

    /*
    // --------------------------------------------------------------------------
    // View
    // --------------------------------------------------------------------------
    $view = \hahahalib\hahaha_view::Instance();
    $view->Start();
    // --------------------------------------------------------------------------        
    \hahaha\view\IndexView::Instance()->xxx();
    // --------------------------------------------------------------------------
    $view->End();
    // --------------------------------------------------------------------------
    */

    //$a = "xxx";
    /*
    // --------------------------------------------------------------------------
    // View(html)
    // --------------------------------------------------------------------------
    $view->Start();
    // --------------------------------------------------------------------------
    ?>
    <? // -------------------------------------------------------------------------- ?>

    <?= $a ?>
    ccc


    <? // -------------------------------------------------------------------------- ?>
    <?php
    // --------------------------------------------------------------------------
    $view->End();
    // --------------------------------------------------------------------------
    */


}