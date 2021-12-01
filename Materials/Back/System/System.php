<?php
class System{
    private $structure = "Structure/Views/";
    public $layoutsVariables;
    public $layoutDatas;
    public function view($view, $layoutOrDatas = null, $datas = null){
        global $viewData;
        if (is_array($layoutOrDatas)){
            $datas = $layoutOrDatas;
            $layout = $this::layout;
        }else{
            $layout = ($layoutOrDatas != null) ? $layoutOrDatas : $this::layout;
        }
        define("view", $view);
        $viewData = $datas;
        extract(blankKeysAssign($this->layoutDatas));
        extract(blankKeysAssign($this->layoutsVariables));
        $parseLayout = explode("/", $layout);
        $layout = $parseLayout[count($parseLayout) - 1];
        array_pop($parseLayout);
        $directory = implode("/", $parseLayout);
        require_once $this->structure. $directory . "/" . "Layout" . $layout . ".php";
    }
}
?>