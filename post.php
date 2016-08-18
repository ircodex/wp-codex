<?php
include 'init.php';
include 'header.php';

$post_id = $_GET['post_id'];

$post = $db->getPost($post_id);
//print_r($post);

?>
<div class="post_container">
<article id="post-page-<?php echo $post['id'];?>">
    
    <!--Check For Deprecated-->
    <?php if($post['deprecated']):?>
        <div class="deprecated">Warning: This function has been deprecated.</div>
    <?php endif;?>
    
    <h1 id="code-snip"><a class="code_snip" href="<?php echo $post['anchor'];?>"><?php echo syntax_highlight($post['code']);?></a></h1>
    
    <!--Check For Description-->
    <?php if(strlen(trim(strip_tags($post['description']))) > 0):?>
<!--    <p id="min-desc" class="min_desc" >-->
    <div class="description-min">
        <div class="description-en active">
            <?php echo $post['description'];?>
        </div>
        <div class="description-fa fa">
            <?php echo $post['description_fa'];?>
        </div>
        <span class="desc-to-fa">Fa</span>
    </div>
    <!--</p>-->
    <?php endif;?>
    
    <!--Check For Full Description-->
    <?php if(strlen(trim(strip_tags($post['full_description']))) > 0):?>
    <div id="full-desc"><?php echo $post['full_description'];?></div>
    <?php endif;?>
    
    
    <?php echo $post['post_return'] == 'None' ? '' : '<section class="return"><b>Return: </b><span class="return-type">' . $post['post_return'] . '</span> ' . $post['return_description'] . '</section>';?>
    
    
    
    <?php $hasUse = false;?>
    <div class="row" id="use-stat">
        <hr>
        <div class="col-lg-6">
            <h2>Used By:</h2>
            <ul>
            <?php
                foreach($db->getUseFileList($post['id'], 'used-by') as $file){
                   $hasUse = true;
                    echo '<li><a href="'.SITE_URL . 'index.php?file='.$file['file_id'].'">'.$file['address'].'</a></li>';
                }
            ?>
            </ul>
        </div>
        <div class="col-lg-6">
            <h2>Uses:</h2>
            <ul>
            <?php
                foreach($db->getUseFileList($post['id'], 'uses') as $file){
                   $hasUse = true;
                    echo '<li><a href="'.SITE_URL . 'index.php?file='.$file['file_id'].'">'.$file['address'].'</a></li>';
                }
            ?>
            </ul>
        </div>
    </div>
    <?php if($post['type'] == 'class' && $db->classHasMethod($post['id'])):?>
    <section class="method-list">
        <hr>
        <h2>Method List:</h2>
        <ul>
        <?php 
        foreach($db->getClassMethods($post_id) as $data){
            $minPost = $db->getMethodById($data['method_id']);
            echo '<li><a href="#">' . str_replace($post['title'] . '::','',$minPost['title']) . '</a>'. (strlen($minPost['description']) > 0 ? '--'  . $minPost['description'] : '')  . '</li>';
        }?>
        </ul>
    </section>
    <?php endif;?>
    <?php if(!$hasUse):?>
    <style type="text/css">div#use-stat{display: none;}</style>
    <?php endif;?>
    
    <?php
    $parameters = $db->getParameters($post_id);
    if(is_array($parameters) && (count ($parameters) > 0)):?>
    <section class="parameters">
        <h2>Parameters</h2>
        <dl>
        <?php foreach($parameters as $parameter):?>
            <dt><?php echo $parameter['name'];?></dt>
            <dd>
		<p class="desc">
                    <span class="type">(<span class="array"><?php echo $parameter['type'];?></span>)</span>
                    <?php if($parameter['is_require'] != 3):?>
                    <span class="required">(<?php echo $parameter['is_require'] == 1 ? 'Require' : 'Optional'  ?>)</span>
                    <?php if($parameter['description'] != 'None') echo '<span class=\'return-description\'>' . $parameter['description'] . '</span>';?>
                    <?php endif;?>
		</p>
                <?php if($parameter['default_value'] != 'None'):?>
		<p class="default">Default value: <?php echo $parameter['default_value'];?></p>
                <?php endif;?>
            </dd>
        <?php endforeach;?>
        </dl>
    </section>
    <?php endif;?>
    
    <?php
        if($post['source_code'] != 'None'){
            echo '<hr><h2 id="source-code" class="source-code">Souce code:</h2>' . PHP_EOL;
            echo $post['source_code'];
        }
    ?>
    
    
    
    <?php if($post['change_log'] != 'None'):?>
    <div class="change-log" id="change-log">
        <b> Since: </b> Wordpress <a href="<?php echo SITE_URL . 'index.php?since=' .$post['change_log']; ?>"><?php echo $post['change_log'];?></a>
    </div>
    <?php endif;?>
    <div class="source" id="souce-file">
        Source: <?php echo '<a href="'.SITE_URL.'index.php?file='.$post['source_file'].'">' . $post['address'] . ':' . $post['source_line'] . '</a>';?>
    </div>
</article>
</div>
<?php include 'footer.php';?>