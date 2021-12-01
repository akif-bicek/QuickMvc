<?php
class MessagesModel {
    public static function messages($type, $id){
        return getDatas("select * from messages where Type = ? and ItemID = ?",  $type, $id);
    }
    public static function messagesList($offset, $filter){
        return getDatas("select * from messages order by ID desc limit $offset, $filter");
    }
    public static function addMessage($comment, $name, $email, $phone, $time, $type, $itemID){
        if (!arrayIsNull(func_get_args())){
            return addData(
                "messages",
                "Comment,Name,Email,Phone,PostDate,Type,ItemID",
                $comment, $name, $email, $phone, $time, (int)$type, $itemID
            );
        }
    }
    public static function messageDelete($id){
        return deleteData("messages", $id);
    }
    public static function message($id){
        editData("messages", "Readed", $id, 1);
        return getDatas("select * from messages where ID = ? limit 1", $id);
    }
    public static function unreadMessages(){
        return getDatas("select * from messages where Readed = 0 order by ID desc limit 10");
    }
}
?>