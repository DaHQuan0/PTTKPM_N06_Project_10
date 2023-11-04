<?php
include './Db.class.php';
include './Model.php';

session_start();
$imageModel = new PostModel();
$commentModel = new CommentModel();
// $BASE_URL = "comment.php";

// echo($_SESSION['id']);
$id = $_GET['id'] ?? '';
$post = $imageModel->getPostbyId($id);


//xu ly them comment khi duoc submit
$content = $_POST['content'] ?? null;
if ($content != null) {
    $user = $_GET['user'];

    $commentModel->addComment($id, $content, $user);
    header('Location: comment.php?id=' . $id);
}

$comments = $commentModel->getCommentsByPost($id);

//neu khong tim thay bai thi hien not found
if ($post == null) {
    include 'not-found.php';
} //nguoc lai thi hien html
else { ?>
    <html lang="en">
    <head><title><?php echo $post['username'] . '\'s art' ?></title></head>
    <link rel="stylesheet"
          href=
          "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="style.css" rel="stylesheet" type="text/css">
    <script>
        async function share(link) {
            try {
                await navigator.clipboard.writeText(link)
                alert('Đã lưu link vào clipboard')
            } catch (e) {
                alert(`Không thể share:${e}`)
            }
        }

    </script>
    <body>
    <div class="page-container">
        <div class="image-container">
            <img src="<?php echo $post['image'] ?>"
                 alt="<?php echo $post['username'] . '\'s image' ?>"/>

        </div>

        <div class="right-container">
            <div style="flex: 3">
                <div class="owner-info">
                    <img src="<?php echo $post['user_image'] ?>" alt="user avatar"/>
                    <a class="username-link"><?php echo $post['username'] ?></a>
                </div>
                <hr/>
                <button class="btn" onclick="share('<?php echo 'comment.php?id=' . $post['id'] ?>')"><i
                            class="fa fa-share"></i> Chia sẻ
                </button>
                <button class="btn" onclick="share('<?php echo 'comment.php?id=' . $post['id'] ?>')"><i
                            class="fa fa-thumbs-up"></i> LIKE
                </button>
                <hr/>
            </div>

            <div style="overflow-y: scroll; padding-bottom: 40px ">
                <?php foreach ($comments as $comment) {
                    ?>
                    <div class="comment-container">
                        <img src="<?php echo $comment['user_image'] ?>"
                             alt="<?php echo $comment['username'] ?>"/>
                        <div style=" display: flex;flex-direction: column;  padding-right: 10px;width: 100%;">

                            <div class="comment-content">
                                <a class="username-link"><?php echo $comment['username'] ?></a>
                                <p> <?php echo $comment['content'] ?></p>

                            </div>
                            <a class="comment-date"><?php echo date_format(date_create($comment['created_at']), 'd/m/y H:i') ?></a>
                        </div>

                    </div>
                <?php } ?>

            </div>
            <div class="comment-input-container">
                <form class="comment-input-form" action="comment.php?id=<?php echo $id ?>&user=<?php echo $_SESSION['id']?>" method="post">
                    <input class="text-input" name="content" type="text"/>
                    <button class="submit" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>


    </body>
    </html>

<?php } ?>
