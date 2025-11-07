<form action="" method="post">
    <input type="hidden" name="questionid" value="<?=$question['id']; ?>">
    <label for='questiontext'>Edit your question here;</label>
    <textarea name="questiontext" rows="3" cols="40">
    <?=$question['questiontext']?>
    </textarea>
<input type="submit" name="submit" value="Save">
</form>