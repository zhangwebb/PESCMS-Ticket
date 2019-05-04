<?php

namespace Core\Plugin;

/**
 * 插件控制器
 */
class PluginController extends \Core\Controller\Controller {

    protected $pluginPath = [];
    
    public function __init() {
        $this->getPluginPath();
    }


    protected function display($themeFile='') {
        echo '<b>Parse error:</b>禁止调用Plugin\Plugin::display()';
        exit;
    }

    protected function layout($themeFile = '', $layout = "layout") {
        echo '<b>Parse error:</b>禁止调用Plugin\Plugin::layout()';
        exit;
    }

    protected function view($file){
        /* 加载标签库 */
        $label = new \Expand\Label();

        if (!empty(\Core\Func\CoreFunc::$param)) {
            extract(\Core\Func\CoreFunc::$param, EXTR_OVERWRITE);
        }

        require "{$this->pluginPath['view']}/view/{$file}.php";
    }

    protected function viewLayout($file, $layout = 'layout'){
        /* 加载标签库 */
        $label = new \Expand\Label();

        if (!empty(\Core\Func\CoreFunc::$param)) {
            extract(\Core\Func\CoreFunc::$param, EXTR_OVERWRITE);
        }
        $file = "{$this->pluginPath['view']}/view/{$file}.php";
        require THEME_PATH."/{$layout}.php";
    }

    /**
     * 获取当前运行插件的地址
     * @throws \Exception
     */
    private function getPluginPath(){
        $pluginClass = get_called_class();
        if(empty($pluginClass)){
            throw new \Exception("获取插件地址失败");
        }
        $split = explode('\\', $pluginClass);

        $this->pluginPath['plugin'] = PES_CORE."{$split[0]}/{$split[1]}";
        $this->pluginPath['view'] = PES_CORE."Public/{$split[0]}/{$split[1]}";
    }

}