<?php
// config
$link_limit = 9; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>

<?if ($data['paginator']->lastPage() > 1){?>
<ul class="pagination">
    <li class="<?
    if($data['paginator']->currentPage() == 1)
        echo' disabled'
    ?>">
        <a href="<? echo $data['paginator']->url(1) ?>">Первая</a>
    </li>
    <?if($data['paginator']->currentPage()-4>1){?>
        <li>
            <a>...</a>
        </li>
    <?}?>
    <?for ($i = 1; $i <= $data['paginator']->lastPage(); $i++) {
        $half_total_links = floor($link_limit / 2);
        $from = $data['paginator']->currentPage() - $half_total_links;
        $to = $data['paginator']->currentPage() + $half_total_links;
        if ($data['paginator']->currentPage() < $half_total_links) {
            $to += $half_total_links - $data['paginator']->currentPage();
        }
        if ($data['paginator']->lastPage() - $data['paginator']->currentPage() < $half_total_links) {
            $from -= $half_total_links - ($data['paginator']->lastPage() - $data['paginator']->currentPage()) - 1;
        }
        if ($from < $i && $i < $to){?>
        <li class="<?
        if($data['paginator']->currentPage() == $i)
            echo 'active'?>
        ">
            <a href="<? echo $data['paginator']->url($i) ?>"><?echo $i?></a>
        </li>
        <?
        }
    }?>
    <?if($data['paginator']->currentPage()+4<$data['paginator']->lastPage()){?>
    <li>
        <a>...</a>
    </li>
    <?}?>
    <li class="<?
    if($data['paginator']->currentPage() == $data['paginator']->lastPage())
        echo 'disabled'
    ?>">
        <a href="<? echo $data['paginator']->url($data['paginator']->lastPage()) ?>">Последняя</a>
    </li>
</ul>
<?}?>


