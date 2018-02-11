<div id="main">
    <div id="post">
        <h4>Сортировка</h4>
        <select class="sort" name="sort">
            <option value="id" <? echo(empty($_GET['sort']) ? 'selected' : '')?>>по id</option>
            <option value="name" <? echo($_GET['sort']=='name' ? 'selected' : '')?>>по имени</option>
            <option value="email" <? echo($_GET['sort']=='email' ? 'selected' : '')?>> по email </option>
            <option value="status" <? echo($_GET['sort']=='status' ? 'selected' : '')?>>по статусу</option>
        </select>
        <ul class="posts_list">
            <?foreach($data['items'] as $task){?>
            <li class="main_post">
               <div class="post_author">
                   <?if(!empty($task['img'])){
                     echo  '<img src="uploaded/'.$task['img'].'?>">';
                    }?>

                   <h3><?echo $task['name']?></h3>
                    <span class="status">
                        <?$task['status']==1 ? $box = 'checked_box.png' : $box = 'unchecked_box.png'?>
                        <? echo($_SESSION['login'] == 'admin' ? '<a data-id='.$task['id'].' class="task_status" href="javascript:;">' : '')?>
                            <img class="check_status" data-id="<?echo$task['id']?>" style="width:50px;height: 50px" src="/web/static/img/<?echo $box?>">
                        <? echo($_SESSION['login'] == 'admin' ? '</a>' : '')?>
                    </span>
                   <h4><?echo $task['email']?></h4>
                   <p class="task_content" data-id="<?echo $task['id']?>">
                       <?echo $task['content']?>
                   </p>
                   <? echo($_SESSION['login'] == 'admin' ? '<a data-id="'.$task['id'].'" class="task_edit" href="javascript:;">Редактировать текст</a>' : '')?>
               </div>
            </li>
            <?}?>
        </ul>
        <div id="pagination">
            <?include './web/application/views/pagination.php'?>
        </div>
    </div>
    <div id="post_form">
        <h1> Создать задачу </h1>
        <?  if($_SESSION['errors']){?>
            <div id='alert'>
                <div class=' alert alert-block alert-info fade in center'>
                    <?echo $_SESSION['errors']?>
                </div>
            </div>
            <?
            unset($_SESSION['errors']);
        }?>
        <div id="preview_error"></div>
        <div id="preview">
        </div>
        <form enctype="multipart/form-data" id="create_post" method="POST" action="/tasks/create">
            <div class="form-group">
                <label>Имя:</label>
                <input name="name" style="width: 200px" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="img">Картинка:</label>
                <input id="image" name="img" style="width: 200px" type="file" class="form-control" id="img">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input name="email" style="width: 200px" type="text" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="content">Текст:</label>
                <textarea name="content" style="height: 200px;width:800px;" class="form-control" id="pwd"></textarea>
            </div>
            <div class="form-group">
                <label><a id="preview_button" href="javascript:;">Предварительный просмотр</a></label>
            </div>
            <input type="hidden" name="token" value="<?php
            echo $_SESSION['token'];
            ?>" />
            <button type="submit" class="btn btn-default">Создать</button>
        </form>
    </div>
</div>