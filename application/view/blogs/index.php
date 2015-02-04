<div class="container">
    <h2>You are in the View: application/view/blog/index.php (everything in this box comes from that file)</h2>
    <!-- add song form -->
    <div class="box">
        <h3>Add a blog</h3>
        <form action="<?php echo URL; ?>blogs/addblog" method="POST">
        	<label>Title</label>
            <input type="text" name="title" value="" />
            <label>Author</label>
            <input type="text" name="author" value="" required />
            <label>Content</label>
            <input type="text" name="content" value="" required />
            <input type="submit" name="submit_add_blog" value="Submit" />
        </form>
    </div>
    <!-- main content output -->
    <div class="box">
        <h3>List of blogs (data from first model)</h3>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>Id</td>
                <td>Title</td>
                <td>Author</td>
                <td>Content</td>
                <td>DELETE</td>
                <td>EDIT</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($this->blogs as $blog) { ?>
                <tr>
                    <td><?php if (isset($blog->id)) echo htmlspecialchars($blog->id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($blog->author)) echo htmlspecialchars($blog->author, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($blog->title)) echo htmlspecialchars($blog->title, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($blog->content)) echo htmlspecialchars($blog->content, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><a href="<?php echo URL . 'blogs/deleteblog/' . htmlspecialchars($blog->id, ENT_QUOTES, 'UTF-8'); ?>">delete</a></td>
                    <td><a href="<?php echo URL . 'blogs/editblog/' . htmlspecialchars($blog->id, ENT_QUOTES, 'UTF-8'); ?>">edit</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
