<div class="container">

	<h3>Add a photo</h3>
    <form action="<?php echo URL; ?>photos/addphoto" method="POST" enctype="multipart/form-data" >
		<input type="file" name="file" required/>
		<input type="submit" name="submit" value="Upload"/>
	</form>

	<div class="container">
    <div class="box">
        
    <h3>List of photos</h3>
    	<table>
        <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>ID</td>
                <td>Afbeelding</td>
            </tr>
            </thead>
            <tbody>
	            <?php foreach ($this->photos as $photo) { ?>
	                <tr>
	                    <td><?php if (isset($photo->id)) echo htmlspecialchars($photo->id, ENT_QUOTES, 'UTF-8'); ?></td>
	                    <td><img width="100" src="<?php if (isset($photo->pathname)) echo URL .'public/img/' . $photo->pathname ;?>"</td>
                        <td> <a href="<?php echo URL . 'game/play/' . htmlspecialchars($photo->id, ENT_QUOTES, 'UTF-8'); ?>""> <button name="play" value= "<?php $photo->id ?>">Play with this Photo</button> </a> </td>
	                </tr>
	            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>
