<?php
require '../../config/keys.php';
include '../../core/db_connect.php';

$content="<h1>Blog Posts</h1>";
$stmt = $pdo->query('SELECT * FROM posts');

while ($row = $stmt->fetch())
{
    $content .= "<div><a href=\"view.php?slug={$row['slug']}\">{$row['title']}</a></div>";
}

$content .= <<<EOT
<div class="form-group">
    <a href="add.php" class="btn btn-primary">New Post</a>
</div>
EOT;


include '../../core/layout.php';
