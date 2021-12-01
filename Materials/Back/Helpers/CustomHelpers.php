<?php
function savingUrls($controller){
    $page = getDatas("select * from urls where SefLink = ? limit 1", $controller["action"]);
    if ($page == false){
        return false;
    }else{
        return array("action" => $page["Action"], "params" => array_merge(arrayBlankClear(explode("&", $page["Parameters"])), $controller["params"]));
    }
}
function setCurrentLanguage($short = null){
    if ($short != null){
        $return = true;
        $lang = getDatas("select ID,Tag,Short from languages where Short = ? limit 1", $short);
        if ($lang == false){
            $return = false;
            $lang = getDatas("select ID,Tag,Short,DefaultLanguage from languages where DefaultLanguage = 1 limit 1");
            define("langshort", "");
            define("languageshort", $lang["Short"] ?? "en");
        }else{
            define("langshort", $lang["Short"] . "/" ?? "en/");
            define("languageshort", $lang["Short"] ?? "en");
        }
        define("lang", $lang["ID"] ?? 1);
        define("language", $lang["Tag"] ?? "en-US");
        return $return;
    }else{
        $lang = getDatas("select ID,Tag,Short,DefaultLanguage from languages where DefaultLanguage = 1 limit 1");
        define("lang", $lang["ID"] ?? 1);
        define("language", $lang["Tag"] ?? "en-US");
        define("langshort", "");
        define("languageshort", $lang["Short"] ?? "en");
    }
}
function groupCategories($products){
    $arr = array();
    foreach (falseToArray($products) as $product){
        $arr[] = $product["CategoryID"];
    }
    return implode(",", $arr);
}
function getCategoryName($id, $categories){
    $return = "blank";
    foreach ($categories as $category){
        if ($id == $category["ID"]){
            $return = $category["Name"];
        }
    }
    return $return;
}
function saveUrl($action, $titleOrDatas, $id = 0, $langID = 0){
    if ($action == "edit"){
        return UrlsModel::editUrl($id, $titleOrDatas, $langID);
    }elseif ($action == "add"){
        return UrlsModel::addUrl($titleOrDatas);
    }elseif($action == "addParams"){
        return UrlsModel::addParameters($id, $titleOrDatas);
    } else{
        return false;
    }
}
function saveTags($action, $tags, $type, $id, $langID){
    if ($action == "edit"){
        if (TagsModel::tagsClear($id)){
            return TagsModel::tagsAdd($tags, $type, $id, $langID);
        }else{
            return false;
        }
    }elseif ($action == "add"){
        return TagsModel::tagsAdd($tags, $type, $id, $langID);
    }else{
        return false;
    }
}
function viewCounter($table, $column, $id = 0){
    if ($id == 0){
        runSql("update {$table} set {$column} = {$column} + 1 where LangID = ?", lang);
    }else{
        runSql("update {$table} set {$column} = {$column} + 1 where LangID = ? and ID = ?", lang, $id);
    }
}
function sc($key){
    $content = getDatas("select * from systemcontents where LangID = ? and LangKey = ? order by ID desc limit 1",  lang, $key);
    echo $content["Text"] ?? $key;
}
function scr($key){
    $content = getDatas("select * from systemcontents where LangID = ? and LangKey = ? order by ID desc limit 1",  lang, $key);
    return $content["Text"] ?? $key;
}
function au($url){
    echo "admin/" . langshort . $url;
}
function aur($url){
    return "admin/" . langshort . $url;
}
function trDate($datetime, $format = 'j F Y , l H:i'){
    if (language != "tr-TR"){
        $format = "F j, Y, g:i a";
        return date($format, $datetime);
    }else{
        $z = date("$format", $datetime);
        $gun_dizi = array(
            'Monday'    => 'Pazartesi',
            'Tuesday'   => 'Salı',
            'Wednesday' => 'Çarşamba',
            'Thursday'  => 'Perşembe',
            'Friday'    => 'Cuma',
            'Saturday'  => 'Cumartesi',
            'Sunday'    => 'Pazar',
            'January'   => 'Ocak',
            'February'  => 'Şubat',
            'March'     => 'Mart',
            'April'     => 'Nisan',
            'May'       => 'Mayıs',
            'June'      => 'Haziran',
            'July'      => 'Temmuz',
            'August'    => 'Ağustos',
            'September' => 'Eylül',
            'October'   => 'Ekim',
            'November'  => 'Kasım',
            'December'  => 'Aralık',
            'Mon'       => 'Pts',
            'Tue'       => 'Sal',
            'Wed'       => 'Çar',
            'Thu'       => 'Per',
            'Fri'       => 'Cum',
            'Sat'       => 'Cts',
            'Sun'       => 'Paz',
            'Jan'       => 'Oca',
            'Feb'       => 'Şub',
            'Mar'       => 'Mar',
            'Apr'       => 'Nis',
            'Jun'       => 'Haz',
            'Jul'       => 'Tem',
            'Aug'       => 'Ağu',
            'Sep'       => 'Eyl',
            'Oct'       => 'Eki',
            'Nov'       => 'Kas',
            'Dec'       => 'Ara',
        );
        foreach($gun_dizi as $en => $tr){
            $z = str_replace($en, $tr, $z);
        }
        if(strpos($z, 'Mayıs') !== false && strpos($format, 'F') === false) $z = str_replace('Mayıs', 'May', $z);
        return $z;
    }
}
function getSettings($col){
    $sett = getDatas("select ID,{$col} from settings where langID = ? limit 1", lang);
    return ($sett != false) ? $sett[$col] : "Karmızı";
}
function adminHeaderAction($prev, $next, $currentPage, $action = "", $link = "", $linktext = ""){
    adminHeader($prev, $next, $currentPage, $link, $linktext, $action);
}
function adminHeader($prev, $next, $currentPage, $link = "", $linktext = "", $action = ""){
    if($action != ""){
        $action = '<h6 class="card-subtitle mb-2 text-muted">'. scr($action) .'</h6>';
    }
    if ($link != ""){
        $link = '<a href="'. aur($link) .'" class="btn btn-primary btn-lg align-right"> '. scr($linktext) .' </a>';
    }
    echo '
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="'. aur($prev[0]) .'">'. scr($prev[1]) .'</a></li>
            <li class="breadcrumb-item active"><a href="'. aur($next[0]) .'">'. scr($next[1]) .'</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body row">
                <div class="col-lg-6">
                    <h2><b class="text-primary">'. getSettings("SiteName") .'</b> Panel</h2>
                        <h4>'. scr($currentPage) .'</h4>
                        '. $action .'
                    </div>
                <div class="col-lg-6 text-right">
                    '. $link .'
                </div>
            </div>
        </div>
    </div>
</div>
';
}
/*$keys = [
    "t--key","st--key","fb--key--textkey"
];*/
function adminLister($type, $datas, $keys){
    // background  c - b
    // row c-t-cf
    // key(column) type t st i te ft fb fl
    $type = explode("-", $type);
    $bg = $type[0];
    $row = $type[1];
    $filters = $type[2] ?? "";
    $link = currentAction();
    echo "<div class='container-fluid'>";
    if(strpos($filters, "s") !== false):
        echo "<div class='card'>
                <div class='card-body row'>
                    <div class='col-lg-10'>
                        <input type='text' placeholder='". scr('search') ."' class='form-control valid' id='search'>
                    </div>
                    <div class='col-lg-2 text-right'>
                        <button onclick='search(\"$link\")' class='btn btn-primary h-100'>". scr('search') ."</button>
                    </div>
                </div>
              </div>";
    endif;
    echo ($bg == "c") ? "<div class='card'><div class='card-body'>" : "";
    if ($row[0] == "c"){
        echo '<div class="row">';
        if (count($datas) != 0){
            foreach ($datas as $data){
                $body = "";
                $footer = "";
                $image = "";
                foreach ($keys as $k => $key){
                $keyInfos = explode("--", $key);
                $key = $keyInfos[1];
                $text = $keyInfos[2] ?? "";
                if ($keyInfos[0] == "i"){
                    $image .= '<img class="img-fluid" src="'. uploadsr($data[$key]) .'">';
                }
                echo ($k == 0) ? '' : "";
                    if ($keyInfos[0] == "t"){
                        $body .= '<h5 class="card-title">'. $text . $data[$key] .'</h5>';
                    }
                    if ($keyInfos[0] == "st"){
                        $body .= '<h6 class="card-subtitle mb-2 text-muted">'. $text . $data[$key] .'</h6>';
                    }
                    if ($keyInfos[0] == "std"){
                        $body .= '<h6 class="card-subtitle mb-2 text-muted">'. $text . trDate($data[$key]) .'</h6>';
                    }
                    if ($keyInfos[0] == "te"){
                        $body .= '<p class="card-text">'. characterLimiter(strip_tags(decodeSecurity($data[$key])), 136, "...") .'</p>';
                    }
                    if(($row != "cf") and ($keyInfos[0] == "ft")){
                        $body .= '<p class="card-text d-inline"><small class="text-muted">'. $text . $data[$key] .'</small></p>';
                    }
                    if (($row != "cf") and ($keyInfos[0] == "fl")){
                        $body .= '<a href="'. aur($keyInfos[3] . "/" . $data[$key]) .'" class="card-link float-right"><small>'. scr($keyInfos[2]) .'</small></a>';
                    }
                    if (($row != "cf") and ($keyInfos[0] == "fb")){
                        $body .= '<a href="'. aur($keyInfos[3] . "/" . $data[$key]) .'" class="btn btn-sm btn-'. $keyInfos[4] .' float-right"><small>'. scr($keyInfos[2]) .'</small></a>';
                    }
                    if($row == "cf"){
                        if($keyInfos[0] == "ft"){
                            $footer .= '<p class="card-text d-inline"><small class="text-muted">'. $text . $data[$key] .'</small></p>';
                        }
                        if ($keyInfos[0] == "fl"){
                            $footer .= '<a href="'. aur($keyInfos[3] . "/" . $data[$key]) .'" class="card-link float-right"><small>'. scr($keyInfos[2]) .'</small></a>';
                        }
                        if ($keyInfos[0] == "fb"){
                            $footer .= '<a href="'. aur($keyInfos[3] . "/" . $data[$key]) .'" class="btn btn-sm btn-'. $keyInfos[4] .' float-right"><small>'. scr($keyInfos[2]) .'</small></a>';
                        }
                    }
                }

                //$height = $type[3] ?? ($row == "cf") ? 190 : 250;
                $footer = ($row == "cf") ? '<div class="card-footer">'. $footer ."</div>": "";
                echo '<div class="col-md-6 col-lg-3">
                        <div class="card">
                            '. $image .'
                            <div class="card-body">'. $body .'</div>
                            '. $footer .'
                    </div>
                </div>';
            }
        }else{
            echo '<div class="container-fluid mb-5"><h4 class="d-inline">'. scr("no-datas-found") .'</h4></div>';
        }
        echo '
        </div>';
    }elseif($row == "t"){
        $columns = "";
        $rows = "";
        foreach ($keys as $col){
            $keyInfos = explode("--", $col);
            $column = $keyInfos[0];
            $columns .= '<th scope="col">'. scr($column) .'</th>';
        }
        if (count($datas) > 0){
            foreach ($datas as $data){
                $rows .= "<tr>";
                foreach ($keys as $key){
                    $keyInfos = explode("--", $key);
                    $keysCol = $keyInfos[1];
                    $text = $keyInfos[2] ?? "";
                    if($keysCol == "btn"){
                        $rows .= "<td><span>";
                        for ($i = 2; $i < (count($keyInfos)); $i++){
                            $button = buttonBuilder($keyInfos[$i], $data);
                            $rows .= $button;
                        }
                        $rows .= "</span></td>";
                    }else{
                        if($text == "date"){
                            $rows .= '<td>'. trDate($data[$keysCol], "d.m.Y H:i") .'</td>';
                        }elseif ($text == "image"){
                            $rows .= '<td class="w-25"><img src="'. uploadsr($data[$keysCol]) .'" class="img-thumbnail"></td>';
                        }elseif($text == "color"){
                            $rows .= '<td><button class="btn btn-sm" style="width: 25px; height: 25px; background-color: '. $data[$keysCol] .'"></button></td>';
                        }elseif($text == "html"){
                            $rows .= '<td>'. decodeSecurity($data[$keysCol]) .'</td>';
                        }elseif ($text == "link"){
                            $linkText = $keyInfos[3] ?? $data[$keysCol];
                            $rows .= '<td><a href="'. $data[$keysCol] .'" class="card-link" target="_blank">'. $linkText .'</a></td>';
                        }
                        else{
                            $rows .= '<td>'. $text . characterLimiter(strip_tags(decodeSecurity($data[$keysCol])), 100) .'</td>';
                        }
                    }
                }
                $rows .= "</tr>";
            }
        }else{
            $rows .= '<tr><td colspan="'. count($keys) .'"><h4 class="d-inline">'. scr("no-datas-found") .'</h4></td></tr>';
        }
        echo '
            <div class="table-responsive"> 
            <table class="table table-bordered table-striped verticle-middle">
                <thead>
                    <tr>
                        '. $columns .'
                    </tr>
                </thead>
                <tbody>
                    '. $rows .'
                </tbody>
            </table>
        </div>
        ';
    }
    $currentUrl = currentUrl();
    $forwad = $currentUrl[1];
    $back = $currentUrl[0];
    echo ($bg == "c") ? "</div></div>" : "";
    if(strpos($filters, "p") !== false){
        echo "<div class='card'>
            <div class='card-body row'>
                <div class='col-lg-6 text-left'>
                    <a href='$back' class='btn btn-primary h-100'>". scr('back') ."</a>
                </div>
                <div class='col-lg-6 text-right'>
                    <a href='$forwad' class='btn btn-primary h-100'>". scr('forward') ."</a>
                </div>
            </div>
          </div>";
    }
    echo "</div>";
}
//["name", "type", "title", "required?", "placeholder?", "false(disabled)?", "selectDatas" => $datas, ?"selectValKey" => "ID", ?"selectDisplayKey" => "Title"];
function adminForms($inputs, $action, $values = null){
    $enctype = (array_search("image", array_column($inputs, 1)) !== false) ? 1 : 0;
    $enctype += (array_search("file", array_column($inputs, 1)) !== false) ? 1 : 0;
    $enctype += (array_search("images", array_column($inputs, 1)) !== false) ? 1 : 0;
    $enctype += (array_search("folder", array_column($inputs, 1)) !== false) ? 1 : 0;
    $enctype = ($enctype > 0) ? 'enctype="multipart/form-data"' : "";
    echo "<div class='container-fluid'>";
    echo '<form class="form-valide" action="Admin/'. $action .'" method="post" novalidate="novalidate" '. $enctype .'>
            <div class="card"><div class="card-body">';
    $sumbitButton = '<div class="form-group row">
            <div class="col-lg-8 ml-auto">
                <button type="submit" class="btn btn-primary">'. scr("submit") .'</button>
            </div>
        </div>';
    $requires = "";
    $requireMessages = "";
    $editorf = "";
    $tagsScripts = false;
    $editorScripts = false;
    $colorpickerScripts = false;
    foreach ($inputs as $input){
        $type = $input[1];
        $nameDataKey = explode("--", $input[0]);
        if (count($nameDataKey) > 1){
            $datakey = $nameDataKey[1];
            $name = $nameDataKey[0];
        }else{
            $datakey = $nameDataKey[0];
            $name = $nameDataKey[0];
        }
        $title = $input[2] ?? "";
        $req = $input[3] ?? "";
        $requireSpan = isNotEmpty($req, '<span class="text-danger">*</span>');
        if($req != ""){
            $requires .= '"'. $name .'": {required: !0},';
            $requireMessages .= '"'. $name .'": "'. scr($req) .'",';
        }
        $ph = $input[4] ?? "";
        $placeholder = isNotEmpty($ph, 'placeholder="'. scr($ph) .'"');
        if($type == "hidden"){
            $value = ($values != null) ? "value='". $values[$datakey] ."'" : "";
            echo "<input type='hidden' name='{$name}' {$value}>";
        }elseif($type == "hiddenvalue"){
            echo "<input type='hidden' name='{$name}' value='{$title}'>";
        }
        elseif ($type == "textarea"){
            $value = ($values != null) ? $values[$datakey] : "";
            echo '<div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-'. $name .'">'. scr($title) .' '. $requireSpan .'</label>
                    <div class="col-lg-6">
                        <textarea class="form-control" id="val-'. $name .'" name="'. $name .'" rows="5" '. $placeholder .'>'. $value .'</textarea>
                    </div>
                </div>';
        }elseif($type == "editor"){
            $editorScripts = true;
            $value = ($values != null) ? $values[$datakey] : "";
            echo '<div class="form-group row">
                    <div class="col-lg-12">
                        <h5>'. scr($title) .' '. $requireSpan .'</h5>
                        <textarea class="summernote" name="'. $name .'">'. decodeSecurity($value) .'</textarea>
                    </div>
                  </div>';
        }elseif($type == "editorf"){
            $editorScripts = true;
            $value = ($values != null) ? $values[$datakey] : "";
            $editorf .= '<div class="card"><div class="card-body">
                   <div class="form-group row">
                    <div class="col-lg-12">
                        <h5>'. scr($title) .' '. $requireSpan .'</h5>
                        <textarea class="summernote" name="'. $name .'">'. decodeSecurity($value) .'</textarea>
                    </div>
                  </div>'. str_replace("col-lg-8", "col-lg-12", $sumbitButton) .'</div></div>';
        }elseif ($type == "tags"){
            $tagsScripts = true;
            $value = ($values != null) ? replaceTagsComma($values[$datakey]) : "";
            //$valueInput = ($values != null) ? '<input type="hidden" value="'. $values[$datakey] .'" name="'. $name .'" aria-required="true" aria-describedby="keywords-error" >': "";
            echo '<div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-'. $name .'">'. scr($title) .' '. $requireSpan .'</label>
                    <div class="col-lg-6">
                        <div class="tags-input val-'. $name .'" data-name="'. $name .'">
                        
                        </div>
                    </div>
                </div>';
            tagsValue("val-$name", $value);
        }elseif($type == "image"){
            $value = ($values != null) ? uploadsr($values[$datakey]) : "";
            echo '<div class="form-group row">
                    <label for="val-'. $name .'" class="col-lg-4">'. scr($title).' '. $requireSpan .'</label>
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-dark" type="button">
                                    <img id="img-'. $name .'" src="'. $value .'" onclick="selectFile(\'val-'. $name .'\');" class="img-fluid">
                                </button>
                            </div>
                            <div class="custom-file">
                                <input accept="image/png,image/jpeg,image/jpg,image/gif" id="val-'. $name .'" type="file" name="'. $name .'" class="custom-file-input">
                                <label class="custom-file-label">'. scr("choose-image-file") .'</label>
                            </div>
                        </div>
                    </div>
                  </div>';
            scriptRunner('
            var src = document.getElementById("val-'. $name .'");
            var target = document.getElementById("img-'. $name .'");
            showImage(src,target);
            ');
        }elseif($type == "file"){
            echo '<div class="form-group row">
                    <label for="val-'. $name .'" class="col-lg-4">'. scr($title).' '. $requireSpan .'</label>
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input id="val-'. $name .'" type="file" name="'. $name .'" class="custom-file-input">
                                <label class="custom-file-label">'. scr("choose-file") .'</label>
                            </div>
                        </div>
                    </div>
                  </div>';
        }elseif($type == "folder"){
            echo '<div class="form-group row">
                    <label for="val-'. $name .'" class="col-lg-4">'. scr($title).' '. $requireSpan .'</label>
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input id="val-'. $name .'" webkitdirectory multiple type="file" name="'. $name .'" class="custom-file-input">
                                <label class="custom-file-label">'. scr("choose-folder") .'</label>
                            </div>
                        </div>
                    </div>
                  </div>';
        } elseif ($type == "select"){
            //"selectDatas" => $datas, ?"selectValKey" => "ID", ?"selectDisplayKey" => "Title","selectedKey"
            $selectValKey = $input["selectValKey"];
            $selectDisplayKey = $input["selectDisplayKey"];
            $selectedKey = $input["selectedKey"] ?? "";
            $options = "";
            foreach ($input["selectDatas"] as $selectOption){
                if ($values != null){
                    $selected = (trim($values[$datakey]) == trim($selectOption[$selectValKey])) ? "selected='selected'" : "";
                    $options .= '<option '. $selected .' value="'. $selectOption[$selectValKey] .'">'. $selectOption[$selectDisplayKey] .'</option>';
                }else{
                    $selected = (trim($selectedKey) == trim($selectOption[$selectValKey])) ? "selected='selected'" : "";
                    $options .= '<option '. $selected .' value="'. $selectOption[$selectValKey] .'">'. $selectOption[$selectDisplayKey] .'</option>';
                }
            }
            echo '<div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-'. $name .'">'. scr($title).' '. $requireSpan .'</label>
                    <div class="col-lg-6">
                        <select class="form-control" id="val-'. $name .'" name="'. $name .'">
                            <option value="">'. scr('please-select') .'</option>
                            '. $options .'
                        </select>
                    </div>
                </div>
            ';
        }elseif($type == "language"){
            $selectValKey = $input["selectValKey"];
            $selectDisplayKey = $input["selectDisplayKey"];
            $options = "";
            foreach ($input["selectDatas"] as $selectOption){
                $selected = ($selectOption[$selectValKey] == lang) ? "selected='selected'" : "";
                if ($values != null){
                    $options .= '<option '. $selected .' value="'. $selectOption[$selectValKey] .'">'. $selectOption[$selectDisplayKey] .'</option>';
                }else{
                    $options .= '<option '. $selected .' value="'. $selectOption[$selectValKey] .'">'. $selectOption[$selectDisplayKey] .'</option>';
                }
            }
            echo '<div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-'. $name .'">'. scr($title).' '. $requireSpan .'</label>
                    <div class="col-lg-6">
                        <select class="form-control" id="val-'. $name .'" name="'. $name .'">
                            <option value="">'. scr('please-select') .'</option>
                            '. $options .'
                        </select>
                    </div>
                </div>
            ';
        }elseif ($type == "color"){
            $value = ($values != null) ? 'value="'. $values[$datakey] .'"' : 'value="#7571f9"';
            $colorpickerScripts = true;
            echo '<div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-'. $name .'">'. scr($title).' '. $requireSpan .'</label>
                    <div class="col-lg-6">
                        <input type="text" '. $value .' class="form-control gradient-colorpicker-colorpicker valid" id="val-'. $name .'" name="'. $name .'">
                    </div>
                </div>';
        }elseif ($type == "dropdowntext"){
            $value = ($values != null) ? 'value="'. $values[$datakey] .'"' : '';
            $buttons = "";
            foreach ($input["ddtDatas"] as $data){
                $func = $input["buttonActionName"] . "('" . $data[$input["ddtValKey"]] . "', 'val-". $name ."');";
                $buttons .= '<a style="cursor: pointer;" class="dropdown-item" onclick="'. $func .'" type="button">'. $data[$input["ddtDisplayKey"]] .'</a> ';
            }
            echo '<div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-'. $name .'">'. scr($title).' '. $requireSpan .'</label>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <input type="text" '. $value .' class="form-control" id="val-'. $name .'" name="'. $name .'">
                            <div class="input-group-append show">
                                <button class="btn btn-outline-dark dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">'. $input["buttonText"] .'</button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                    '. $buttons .'
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        }elseif ($type == "textnoscr"){
            $value = ($values != null) ? 'value="'. $values[$datakey] .'"' : "";
            echo '<div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-'. $name .'">
                    '. $title .' '. $requireSpan .'
                    </label>
                    <div class="col-lg-6">
                        <input type="'. $type .'" '. $value .' class="form-control valid" id="val-'. $name .'" name="'. $name .'" '. $placeholder .'>
                    </div>
                </div>';
        }elseif ($type == "checkbox"){
            $value = ($values != null) ? ($values[$datakey] == 1) ? "checked='checked'": "" : "";
            echo '<div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-'. $name .'">
                    '. scr($title).' '. $requireSpan .'
                    </label>
                    <div class="col-lg-6">
                        <input type="'. $type .'" '. $value .' class="form-control valid" id="val-'. $name .'" name="'. $name .'" '. $placeholder .'>
                    </div>
                </div>';
        }elseif ($type == "images"){
            echo '<div class="form-group row">
                    <label for="val-'. $name .'" class="col-lg-4">'. scr($title).' '. $requireSpan .'</label>
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input accept="image/png,image/jpeg,image/jpg,image/gif" id="val-'. $name .'" type="file" multiple name="'. $name .'[]" class="custom-file-input multi-image">
                                <label class="custom-file-label">'. scr("choose-image-files") .'</label>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-6 row" id="multi-images-'. $name .'">
                        
                    </div>
                  </div>
                  ';
            scriptRunner("
            $('#val-{$name}').on('change', function() {
                imagesPreview(this, 'div#multi-images-{$name}');
            });
            ");
        }
        else{
            $value = ($values != null) ? 'value="'. $values[$datakey] .'"' : "";
            echo '<div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-'. $name .'">
                    '. scr($title).' '. $requireSpan .'
                    </label>
                    <div class="col-lg-6">
                        <input type="'. $type .'" '. $value .' class="form-control valid" id="val-'. $name .'" name="'. $name .'" '. $placeholder .'>
                    </div>
                </div>';
        }
    }
    $sumbitButton = ($editorScripts) ? str_replace("col-lg-8", "col-lg-12", $sumbitButton) : $sumbitButton;
    echo ($editorf == "") ? $sumbitButton : "";
    echo  '</div></div>'. $editorf .'</form>';
    echo "</div>";
    if ($tagsScripts){
        styleImploader("Admin/plugins/tags/tags.css");
        if($values == null){
            scriptImploder("Admin/plugins/tags/tags.js");
        }
    }
    if ($editorScripts){
        styleImploader("Admin/plugins/summernote/dist/summernote.css");
        scriptImploder("Admin/plugins/summernote/dist/summernote.min.js");
        scriptRunner('
                jQuery(document).ready(function(){$(".summernote").summernote({height:450,minHeight:null,maxHeight:null,focus:!1});});
            ');
    }
    if($colorpickerScripts){
        scriptImploder("Admin/plugins/jquery-asColorPicker-master/libs/jquery-asColor.js");
        scriptImploder("Admin/plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js");
        scriptImploder("Admin/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js");
        scriptRunner('
        (function($) {
            "use strict"
            $(".gradient-colorpicker-colorpicker").asColorPicker({
                mode: \'gradient\'
            });
        })(jQuery);
        ');
    }
    scriptImploder("Admin/plugins/validation/jquery.validate.min.js");
    scriptRunner('
        jQuery(".form-valide").validate({
        ignore: [],
        errorClass: "invalid-feedback animated fadeInDown",
        errorElement: "div",
        errorPlacement: function(e, a) {
            jQuery(a).parents(".form-group > div").append(e)
        },
        highlight: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
        },
        success: function(e) {
            jQuery(e).closest(".form-group").removeClass("is-invalid"),
            jQuery(e).remove()
        },
        rules: {
            '. rtrim($requires, ",") .'
        },
        messages: {
            '. rtrim($requireMessages, ",") .'
        }
    });
   ');
}
function replaceTagsComma($tags){
    $tags = explode(",", $tags);
    $return = "";
    foreach ($tags as $tag){
        $return .= 'addTag("'. $tag .'");';
    }
    return $return;
}
function tagsCombine($tags){
    $tagsString = "";
    foreach (falseToArray($tags) as $tag){
        $tagsString .= $tag["Name"] . ",";
    }
    return rtrim($tagsString ,",");
}
function tagsValue($class, $tags){
    if ($tags != ""){
        scriptRunner("
        [].forEach.call(document.getElementsByClassName('$class'), function (el) {
        let hiddenInput = document.createElement('input'),
        mainInput = document.createElement('input'),
        tags = [];
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', el.getAttribute('data-name'));
        mainInput.setAttribute('type', 'text');
        mainInput.classList.add('main-input');
        mainInput.addEventListener('input', function () {
        let enteredTags = mainInput.value.split(',');
        if (enteredTags.length > 1) {
            enteredTags.forEach(function (t) {
                let filteredTag = filterTag(t);
                if (filteredTag.length > 0)
                    addTag(filteredTag);
            });
            mainInput.value = '';
        }
        });
        mainInput.addEventListener('keydown', function (e) {
        let keyCode = e.which || e.keyCode;
        if (keyCode === 8 && mainInput.value.length === 0 && tags.length > 0) {
            removeTag(tags.length - 1);
        }
        });
        el.appendChild(mainInput);
        el.appendChild(hiddenInput);
        $tags               
        function addTag (text) {
        let tag = {
            text: text,
            element: document.createElement('span'),
        };           
        tag.element.classList.add('tag');
        tag.element.textContent = tag.text;
        let closeBtn = document.createElement('span');
        closeBtn.classList.add('close');
        closeBtn.addEventListener('click', function () {
            removeTag(tags.indexOf(tag));
        });
        tag.element.appendChild(closeBtn);
        tags.push(tag);
        el.insertBefore(tag.element, mainInput);
        refreshTags();
        }
        function removeTag (index) {
        let tag = tags[index];
        tags.splice(index, 1);
        el.removeChild(tag.element);
        refreshTags();
        }
        
        function refreshTags () {
        let tagsList = [];
        tags.forEach(function (t) {
            tagsList.push(t.text);
        });
        hiddenInput.value = tagsList.join(',');
        }
        
        function filterTag (tag) {
        return tag.replace(/[^\w -]/g, '').trim().replace(/\W+/g, '-');
        }
        });
    ");
    }
}
function buttonBuilder($properties, $data){
    $properties = ltrim($properties, "(");
    $properties = rtrim($properties, ")");
    $btn = explode(" | ", $properties);
    $key = $btn[0];
    $url = $btn[2];
    $btnStyle = $btn[3];
    $text = $btn[1];
    $condition = $btn[4] ?? "";
    if($condition != ""){
        $cond = ($condition[0] == "!") ? !$data[ltrim($condition, "!")] : $data[$condition];
        if ($cond){
            return '<a href="'. aur($url . "/" . $data[$key]) .'" class="btn btn-sm btn-'. $btnStyle .' float-right"><small>'. scr($text) .'</small></a>';
        }else{
            return "";
        }
    }else{
        return '<a href="'. aur($url . "/" . $data[$key]) .'" class="btn btn-sm btn-'. trim($btnStyle) .' float-right"><small>'. scr($text) .'</small></a>';
    }
}
function uploadImages($key, $type, $itemID){
    $images = $_FILES[$key];
    foreach ($images["name"] as $key => $image){
        $file = [
            "name" => $image,
            "type" => $images["type"][$key],
            "tmp_name" => $images["tmp_name"][$key],
            "error" => $images["error"][$key],
            "size" => $images["size"][$key]
        ];
        $path = upload($file, "image", language);
        if ($path != false){
            addData("images", "Path,Type,ItemID", $path, $type, $itemID);
        }
    }
}
function currentUrl($link = null){
    if($link == null){
        global $actual_link;
        $bars = explode("/", $actual_link);
    }else{
        $bars = explode("/", $link);
    }
    if(strpos($bars[count($bars) - 1], "?") !== false){
        $last = explode("?", $bars[count($bars) - 1]);
        $query = "?" . $last[1];
        $last = (int)$last[0];
    }else{
        $last = $bars[count($bars) - 1];
        $query = "";
    }
    $forwad = "";
    $back = "";
    if (is_numeric($last)){
        unset($bars[count($bars) - 1]);
        $urls = implode("/", $bars);
        $forwad = $urls. "/" . (numbersFilter($last) + 1) . $query;
        if (($last - 1) > 0){
            $back = $urls . "/" . (numbersFilter($last) - 1) . $query;
        }else{
            $back = $urls . "/" . 0 . $query;
        }
    }else{
        $urls = implode("/", $bars);
        $forwad = $urls . "/" . 1 . $query;
        $back = $urls . "/" . 0 . $query;
    }
    return array($back, $forwad);
}
function currentAction(){
    $action = "";
    if (action != HomeAction){
        $action = action;
    }
    $link = "admin/". langshort . $action;
    return $link;
}
function currentActionHome(){
    $action = "";
    if (action != HomeAction){
        $action = action;
    }
    $link = langshort . $action . "/";
    return $link;
}
function multiUploadProducts($products, $categoryID, $langID){
    foreach ($products as $name){
        ProductsModel::addProduct($name, $name, $name, $categoryID, $name, $langID, $name, $name);
    }
}
function buildProductName($name){
    $productFileName = explode(".", $name);
    if (count($productFileName) == 3){
        return $productFileName[1];
    }elseif(count($productFileName) == 2){
        return $productFileName[0];
    }else{
        return null;
    }
}
function multiFileUpload(){
    $records = array();
    foreach($_FILES['files']['name'] as $i => $name)
    {
        if((strlen($_FILES['files']['name'][$i]) > 1) and (substr($_FILES['files']['type'][$i], 0, 5) == "image"))
        {
            $itemName = buildProductName($name);
            if($itemName != null){
                if(isset($_FILES[$itemName])){
                    $_FILES[$itemName]["name"][] = $name;
                    $_FILES[$itemName]["type"][] = $_FILES['files']["type"][$i];
                    $_FILES[$itemName]["tmp_name"][] = $_FILES['files']["tmp_name"][$i];
                    $_FILES[$itemName]["error"][] = $_FILES['files']["error"][$i];
                    $_FILES[$itemName]["size"][] = $_FILES['files']["size"][$i];
                }else{
                    $records[] = $itemName;
                    $_FILES[$itemName] = [
                        "name" => [$name],
                        "type" => [$_FILES['files']["type"][$i]],
                        "tmp_name" => [$_FILES['files']["tmp_name"][$i]],
                        "error" => [$_FILES['files']["error"][$i]],
                        "size" => [$_FILES['files']["size"][$i]]
                    ];
                }
            }
        }
    }
    return $records;
}
function multiUploadCategories($categories, $langID){
    foreach ($categories as $name){
        CategoriesModel::addCategory($name, $name, $name, $name, 0, $langID, $name, $name);
    }
}
function altuider(){
    $alt = array("sanat etkinliği", "van art", "görsel sanatlar");
    echo $alt[rand(0, 2)];
}
?>
