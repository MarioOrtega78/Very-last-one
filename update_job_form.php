<?php
//one single echo statement to include the entire job update form
//this contains a hidden input field so that we know which job to update
echo '
<form action="update_job.php" method="POST">
<input type="hidden" name="id" value="'.$id.'">
<label for="completed">
<select name="completed">
    <option value="no" '.$no_completed.'>No</option>
    <option value="yes" '.$yes_completed.'>Yes</option>
</select>
<input type="submit" value="Update">
</form>';
?>
