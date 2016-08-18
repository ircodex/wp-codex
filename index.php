<?php
    include 'init.php';
    include 'header.php';
    
    $requestPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($requestPage - 1) * $postPerPage;
    $totalPost = $db->getPostCount($start, $postPerPage, $type, $since, $search);
    $pageCount = ceil( $totalPost / $postPerPage);
    
    //echo "Start : $start , totalPost : $totalPost , pageCount: $pageCount , RequestPage: $requestPage"
    
//$path = realpath('c:/xampp/htdocs/wordpress/fa/');
//$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
//foreach($objects as $name => $object){
//    if( substr($name,strrpos($name,'.')+1,strlen($name)) == 'php' ){
//        $file = str_replace('C:\\xampp\\htdocs\\wordpress\\fa\\', '', $name) . PHP_EOL;
//        if(!preg_match('/wp-content/si', $file)){
//           $db->
//        }
//        
//    }
//}
?>



<div class="article_container">
    <h3 class="type-ref">
        <?php echo $search == '' ? ucfirst($type) . '' . ($since != '' ? ' : Since wordpress ' .$since : '') : 'Search result for: ' . $search;?>
    </h3>
        <?php if($totalPost == 0):?>
        <div class="no-result">Sorry, No result for your request!</div>
        <?php endif;?>
        <?php foreach($db->getPostList($start, $postPerPage, $type, $since, $search) as $article):?>
        <article id="post-<?php echo $article['id'];?>" class="post">
            <h1><a href="<?php echo SITE_URL;?>post.php?post_id=<?php echo $article['id'];?>"><?php echo str_replace(array('(',')'),'',$article['title']);?></a></h1>
            <p>
                <b><?php echo ucfirst($article['type']);?>: </b><?php echo $article['description'];?>
            </p>
            <?php //print_r($db->getUseFileList($article['id'], 'uses'));?>
        </article>
        <?php endforeach;?>
        
        
   <div class="pagination-new">
       <?php if(!($pageCount < 2 || $totalPost == 0 || $requestPage == 1 )):?>     
       <a href="<?php echo SITE_URL . 'index.php?page=1';?>" class="page">first</a>
       <?php endif;?>
            <?php for($i = 1; $i <= $pageCount; $i++):?>
                <?php if($requestPage == $i):?>
                    <span class="page active"><?php echo $i;?></span>
                <?php else:?>
                    <?php if(abs($i - $requestPage) < 5):?>
                    <a href="<?php echo SITE_URL . 'index.php?page=' . $i; typePagination($type);searchPagination($search);
filePagination($file);?>" class="page"><?php echo $i;?></a>
                    <?php endif;?>
                <?php endif;?>
            <?php endfor;?>
            <?php if(!($pageCount < 2 || $totalPost == 0 || $requestPage == $totalPost )):?>
            <a href="<?php echo SITE_URL . 'index.php?page=' . $pageCount;typePagination($type);searchPagination($search);filePagination($file);?>" class="page">last</a>
            <?php endif;?>
    </div>
    
    
    
</div>
    <?php        include 'footer.php';?>
