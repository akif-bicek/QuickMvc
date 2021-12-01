<?php
class BlogsModel {
    public static function blog($ofset, $limit, $search = "" , $id = 0){
        if ($search != ""){
            $pattern = "%" . $search ."%";
            if ($id != 0){
                return getDatas(
                    "select * from blog where LangID = ? and categoryID = ?
                         and Author like ? or Title like ? or Content like ? order by ID desc limit {$ofset}, {$limit}",
                    lang, $id, $pattern, $pattern, $pattern
                );
            }else{
                return getDatas(
                    "select * from blog where LangID = ? and
                         Author like ? or Title like ? or Content like ? order by ID desc limit {$ofset}, {$limit}",
                    lang, $pattern, $pattern, $pattern
                );
            }
        }else{
            if($id != 0){
                return getDatas("select * from blog where LangID = ? and categoryID = ? order by ID desc limit {$ofset}, {$limit}",
                    lang, $id);
            }else{
                return getDatas("select * from blog where LangID = ? order by ID desc limit {$ofset}, {$limit}", lang);
            }
        }
    }
    public static function detailBlog($id){
        $blog = getDatas("select * from blog where ID = ? limit 1", $id);
        $nextBlog = getDatas("select * from blog where LangID = ? and id = (select min(id) from foo where id > ?)", lang, $id);
        $blog["nextTitle"] = $nextBlog["Title"];
        $blog["nextPath"] = $nextBlog["Path"];
        $blog["nextContent"] = $nextBlog["Content"];
        return $blog;
    }
    public static function blogEdit($id){
        return getDatas("select * from blog where ID = ? limit 1", $id);
    }
    public static function deleteBlog($id){
        $path = self::getBlogPath($id);
        $blog = deleteData("blog", $id);
        if ($blog){
            deleteUpload($path);
            TagsModel::tagsClear($id);
            return true;
        }
    }
    public static function getBlogUrl($id){
        $blog = getDatas("select ID,UrlID from blog where ID = ? limit 1", $id);
        return numbersFilter($blog["UrlID"]);
    }
    public static function editBlog($id, $title, $desc, $keywords, $author, $path, $content, $categoryID, $langID){
        if ($path != false){
            return editData(
                "blog",
                "Title,Description,Keywords,Author,Path,Content,CategoryID,LangID",
                $id,
                $title, $desc, $keywords, $author, $path, $content, $categoryID, $langID
            );
        }else{
            return editData(
                "blog",
                "Title,Description,Keywords,Author,Content,LangID",
                $id,
                $title, $desc, $keywords, $author, $content, $categoryID, $langID
            );
        }
    }
    public static function addBlog($title, $desc, $keywords, $author, $path, $content, $categoryID, $langID, $tags){
        if ($path != false){
            $urlID = saveUrl("add", [
                "title" => $title,
                "action" => "blog",
                "langID" => $langID,
                "parameters" => "#"
            ]);
            if ($urlID != false){
                $blogID = addDataReturnAI(
                    "blog",
                    "Title,Description,Keywords,Author,PublishDate,Path,Content,CategoryID,Views,LangID,UrlID",
                    $title, $desc, $keywords, $author, time(), $path, $content, $categoryID, 0, $langID, $urlID
                );
                if ($blogID != false){
                    saveTags("add", $tags, 2, $blogID, $langID);
                    return saveUrl("addParams", $blogID, $urlID);
                }else{
                    return false;
                }
            }else{
                return  false;
            }
        }else{
            return false;
        }
    }
    public static function getBlogPath($id){
        $blog = getDatas("select ID,Path from blog where ID = ? limit 1", $id);
        return $blog["Path"];
    }
}
?>