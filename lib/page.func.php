<?php


function showPage($page,$totalPage,$where=null,$sep="&nbsp;"){

    $page=@$_REQUEST['page']?(int)$_REQUEST['page']:1;
	$where=($where==null)?null:"&".$where;
	$url = $_SERVER['PHP_SELF'];
	$index = ($page == 1) ? "First" : "<a href='{$url}?page=1{$where}'>First</a>";
	$last = ($page == $totalPage) ? "End" : "<a href='{$url}?page={$totalPage}{$where}'>End</a>";
	$prevPage=($page>=1)?$page-1:1;
	$nextPage=($page>=$totalPage)?$totalPage:$page+1;
	$prev = ($page == 1) ? "<<" : "<a href='{$url}?page={$prevPage}{$where}'><<</a>";
	$next = ($page == $totalPage) ? ">>" : "<a href='{$url}?page={$nextPage}{$where}'>>></a>";
	$str = "{$page}/{$totalPage}";
	for($i = 1; $i <= $totalPage; $i ++) {
		//��ǰҳ������
		if ($page == $i) {
			@$p.= "[{$i}]";
		} else {
			$p.= "<a href='{$url}?page={$i}{$where}'>$sep$sep{$i}$sep$sep</a>";
		}
	}
 	$pageStr=$str.$sep.$sep.$sep.$sep.$sep.$index.$sep.$sep.$sep.$sep.$sep.$prev.$sep.$sep.$sep.$p.$sep.$sep.$sep.$next.$sep.$sep.$sep.$last;
 	return $pageStr;
}


