/**
 * same as the dataclass make cell delete

*/
function makeCellDelete( parameters , _function = 'cell_drop')
{ 
	var ret= '<a href="javascript:'+_function+ '('+parameters+ ');" >';
	ret+='<img src="../img/b_drop.png"  border="0" class="cursorStyle" title="Remove" /></a>' ;
	return ret;
}


function makeCellAdd( parameters , _function = 'cell_add')
{ 
	var ret= '<a href="javascript:'+_function+ '('+parameters+ ');" >';
	ret+='<img src="../img/b_add.png"  border="0" class="cursorStyle" title="Add" /></a>' ;
	return ret; 
}


