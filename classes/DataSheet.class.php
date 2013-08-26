<?php
/************************************************
 *                                         
 *  Qualizone Automation System © 2013
 * ********************************************* 
 * ICT Director: Dr. Ayman Dayekh
 * Developed by: Jamil M. Abdallah, Malak Chaib              
 *  File name:  DataSheet.class.php
 *  Date created: Jun 6, 2013
 * ********************************************* 
 *  class that organizes the creation of tables
 *  with custom styling
 *************************************************/
define("on", 1);
define("off", 0);
/**
 * Class DataSheet 
 *
 */
class DataSheet
{
	/**
	 * The count of datasheets created in same page(instances of this class)
	 *
	 * @var int
	 */
	//static $sCount;
	/**
	 * name assigned to some of iots components
	 * @var string name
	 */
	public $name = "";

	// show/hide checkbox
	public $checkMode = off; 		// on off are defined 1 0 in library.php
	public $editMode = off;			// show/hide edit button
	public $deleteMode = off;		// show/hide delete button
	public $linkMode = on;			// enable/disable linking
	public $link=""; 						// the link lead to when pressing a DataSheet.class record
	public $editImg  =		"b_edit.png"; // imag ot the edit
	public $tableStyleClass			=	"SearchResultTableBorder"; // class of the DataSheet.class table <table>
	public $headerRowStyleClass	=	"TableHeadersColor";			// class of the DataSheet.class header <tr>
	public $thStyleClassFirstTh 	= "RightBorderWhite";				// class of the header data <th>
	public $thStyleClassMidThs 	= "bordered";				// class of the header data <th>
	public $thStyleClassLastTh 	= "";				// class of the header data <th>
	public $tdStyleClass			=	"bordered";	 // cass of the td
	public $thDataStyleClass 		= "TableHeaders";						// class of the header data <th>.. <span>
	public $trStyleClass1				=	"";		// class of content row <tr>
	public $trStyleClass2				=	"";			// class of content row <tr>  a row has two styles to make it easy to distinguish them
	public $trStyleClass3				=	"rowhover";			// class of content row <tr>  when a mouse is over it
	public $tdDataStyleClass			=	"EditBlockTags";					// class of content data <td>.. <span
	public $tdLinksStyleClass			=	"CursorStyle";					// class of content data  that allows linking to  other  pages
	public $checkBocStyleClassFocus 	= "CheckBoxFocus";
	public $checkBoxStyleClass 			= "CheckBox";
	public $miniCellStyleClass	= "BottomBorderWithBg"; // style of the mini cell in the structured class
	public $tdtopborder = "topBorder";
	/*
	$textFieldStyleClass = "EditBlockFields",
	$textFieldStyleClassFocus = "EditBlockFieldsFocus", // The style class i want to have when i focus on the text field
	$selectStStyleClass = "SelectSt",
	$selectStStyleClassFocus = "SelectStFocus", // The style class i want to have when i focus on a select statement
	$checkBocStyleClassFocus = "CheckBoxFocus",
	$checkBoxStyleClass = "CheckBox",
	$cursorStyle = "CursorStyle",
	$buttonStyleClass  = "SaveCancelButton";
	*/
	/**
	 * to switch the background display of consecutive rows 
	 * there might be a need to put it as public 
	 * cause it counts the current rows
	 *
	 * @var int
	 */
	var $itteration=0;
	/**
 * Default Constructor
 * It takes a name string to distinguish 
 *
 * @param string $name
 * @return DataSheet
 */
	function DataSheet($name="DataSheet.class" , $type = "")
	{
		// increase the number of instances of this class
		//$this->sCount ++;
		// set the default name of the instance
		/*if($name=="")
		{
		$name="DataSheet.class".$this->sCount;
		}*/
		$this->checkBoxesArray = null;
		$this->name = $name;
		$this->type = $type;
		$this->tableId = "record";
		$this->checkBoxOnClick = ""; // the function that is executed when a check box is clicked
		$this->selectAll = "on"; // if there are checkboxes is it allowed to have a select all box
		if( $type == "print" )
		{
			$this->tableStyleClass			=	"SearchResultTableBorder"; // class of the DataSheet.class table <table>
			$this->headerRowStyleClass	=	"TableHeadersColor";			// class of the DataSheet.class header <tr>
			$this->thStyleClassFirstTh 	= "RightBorderWhite";				// class of the header data <th>
			$this->thStyleClassMidThs 	= "RightBorderWhite";				// class of the header data <th>
			$this->thStyleClassLastTh 	= "";				// class of the header data <th>
			$this->tdStyleClass			=	"";	 // cass of the td
			$this->thDataStyleClass 		= "TableHeaders";						// class of the header data <th>.. <span>
			$this->trStyleClass1				=	"";		// class of content row <tr>
			$this->trStyleClass2				=	"";			// class of content row <tr>  a row has two styles to make it easy to distinguish them
			$this->trStyleClass3				=	"";			// class of content row <tr>  when a mouse is over it
			$this->tdDataStyleClass			=	"EditBlockTags";					// class of content data <td>.. <span
			$this->tdLinksStyleClass			=	"CursorStyle";					// class of content data  that allows linking to  other  pages
			$this->checkBocStyleClassFocus 	= "CheckBoxFocus";
			$this->checkBoxStyleClass 			= "CheckBox";
			$this->miniCellStyleClass	= "BottomBorderWithBg"; // style of the mini cell in the structured class
			$this->tbalign = "left";
			$this->emptyCellStyleClass="";
		}


	}

	/**
	 *  A function that opens a Sheet table 
	 *
	 * @param string $tableWidth
	 * @param int $cellPadding
	 * @param int $cellSpacing
	 * @param string $tableStyleClass
	 */
	function openSheetTable($id="" , $tableWidth="100%", $cellPadding=0, $cellSpacing=0, $border=0,$align="" )
	{
		$this->tableId=  $id;
		echo '<table id="'.$id.'"  align="'.$align.'" width="' . $tableWidth . '" cellpadding="' . $cellPadding . '" cellspacing="' . $cellSpacing . '" class="' . $this->tableStyleClass . '" border ="' . $border . '">';
	}
	/**
	 * Closes the Sheet table html tags
	 *
	 */
	function closeSheetTable()
	{
		echo '
			<input type = hidden name="'.$this->name.'H" id="'.$this->name.'H" value="'.$this->checkBoxesArray.'">
		</table>';
	}
	/**
	 * A function that adds a Sheet header.
	 * 
	 *
	 * @param array_str $headerLabels is an array that contains the header elements.
	 * @param array_str $headerWidth contains width and/or %width of header elements
	 */
	function addSheetTableHeader($headerLabels, $headerWidth, $align="center",$colspan=1 , $alignLast = "")
	{
		//Gets how many elements are in the array
		//These elements are the header items
		$headerCount = count($headerLabels);

		echo '<thead>
			<tr class=' . $this->headerRowStyleClass . '>';
 
		for ( $i = 0; $i < $headerCount - 1; $i++)
		{
			echo '
				<th nowrap=nowwrap  align='. $align .' width="' . @$headerWidth[$i] . '" class=' . $this->thStyleClassMidThs . '>' . $headerLabels[$i] . '</th>';
		}
		echo '
				<th nowrap=nowwrap  align='. ( $alignLast == "" ? $align : $alignLast ) .' width="' . @$headerWidth[$headerCount - 1] . '" colspan='.$colspan.'  class=' . $this->thStyleClassLastTh . '>' . $headerLabels[$headerCount - 1] . '</th>';
		echo '
			</tr></thead>';
	}

	/**
	 * add a row <tr> for data cells to the DataSheet
	 *
	 */
	function openSheetTableRow($id="" , $highlight = true )
	{
		$this->itteration++;
		if ($id == "" ) $id = time();
			echo '
			<tr  class="' .  ($this->itteration % 2 ?  $this->trStyleClass2 : $this->trStyleClass1)  . '" id="' .$this->tableId . $id .'" '.
			($highlight == true ?
			" onMouseOver=\"this.className=this.className+' ".  $this->trStyleClass3 ."'\"
			 onMouseOut=\"$(this).removeClass('".  $this->trStyleClass3 ."')\"	
			" : "").'>
			'; 
		// add a check box into a td of this row
		if($this->checkMode == on)
		{
			$this->addSheetCell("".$this->makeCellCheckBox($this->name."cb", "1", $id , $this->checkBoxOnClick) ,  false , "1" , "imageAlignment"  );
			$this->checkBoxesArray .= $this->name."cb".$id. " ";
		}
	}


	/**
	 * A function that closes a <tr> opened by the openSheetTableRow() function
	 *
	 */
	function closeSheetTableRow()
	{

		if( $this->deleteMode == on )
		{
			$this->inserCellDelete("");
		}
		echo'
			</tr>';
	}



	/**
	 *  A function that adds a <td> to the Sheet. with its input data
	 *
	 * @param unknown_type $data the element of the TD
	 */
	function addSheetCell($data ="" , $link= "false" , $colspan="1",   $extra = "",$id="") // A cell is a <td>
	{
		$class="class='" .$this->tdStyleClass."'"; 

		echo '
				<td ' . $class . ' colspan="'. $colspan .'"  '.($link == "true" ? '   style="cursor:pointer;padding-right:2px"  onClick="window.location=\''.$this->link.'\'";' : '').'   '. $extra .' valign=top> 
					<span id= \''.$id.'\' class="' . $this->tdDataStyleClass . '">';
		if(strlen($data)==0)
		{
			echo '&nbsp';
		}
		else
		{
			echo $data;
		}
		echo '
					</span>
				</td>
		';
	}
 
 

 

	/**
	 *  A function that adds a <td> to the Sheet. with its input data
	 *
	 * @param unknown_type $data the element of the TD
	 */
	function addSheetEmptycell($colspan="1",$height="1") // A cell is a <td>
	{
		echo '<td height="'. $height .'" class = "'.$this->emptyCellStyleClass.'"  colspan="'. $colspan .'"><img src="../img/spacer.gif" border="0"></td>';
	}


	/**
	 * addes a checkbox field but does not display it
	 *
	 * @param unknown_type $name
	 * @param unknown_type $value
	 * @param unknown_type $statusIdCount
	 */
	function makeCellCheckBox($name, $value, $statusIdCount , $onClick="" , $flag=0)
	{
		return '<input type=checkbox name = "' . $name . ''.$statusIdCount.'" id="' . $name . ''.$statusIdCount.'" value = "'. $value .'" onfocus=this.className=\'' . $this->checkBocStyleClassFocus .'\' onblur=this.className=\'' .
		 $this->checkBoxStyleClass . '\' onClick="'. ( $onClick == "" ? "" : $onClick . ";") .'"    '.($flag>0?"checked" : "").'  >';
	}

	/**
	 * construct a delete button that can either be a plain link to a page
	 * or a javascript that opens the given link in a new window, the given link should be
	 * the delete link of a given record 
	 *
	 * @param string $link
	 * @param boolean $newWindow 
	 * @return string
	 */
 

	function makeCellAdd( $parameters , $_function = 'cell_add')
	{
		$param = is_array($parameters)?  implode(",",$parameters) : $parameters;
		return '<a href="javascript: '.$_function. '('.$param.');" >
		<img src="../img/b_add.png"  border="0" class="cursorStyle" title="'.('Add').'">
		</a>' ; 
	}
	function makeCellDelete( $parameters , $_function = 'cell_drop')
	{ 
		$param = is_array($parameters)?  implode(",",$parameters) : $parameters;
		return '<a href="javascript: '.$_function. '('.$param.');" ><img src="../img/b_drop.png"  border="0" class="cursorStyle" title="'.('Remove').'"></a>' ;

	}
    function makeCellActive( $parameters , $_function = 'cell_active',$flag=0 , $id=0)
	{ 
		$param = is_array($parameters)?  implode(",",$parameters) : $parameters;
	    if($flag==1){$img="../img/deactivate.png";}
	    else $img="../img/activate.png";
		$str='<a href="javascript: '.$_function. '('.$param.');" >
		 <img src='.$img.' id="active'.$id.'" border="0" class="cursorStyle" title="'.('Activate/Deactivate').'"></a>' ;
		$str.= "<input type=hidden id='flag$id' value='$flag'>";
		return $str;
	}
	
	function makeHiddenField($id , $value)
	{ 
		$str =  '
			<input type = hidden name="'.$id.'" id="'.$id.'" value="'.$value.'">
	'; 
		return $str;
	}
	/*
	function makeCellDelete( $link = "" , $display ='')
	{

		return '<a href="javascript:createIframe(\''. $link . '\');"   onclick="return confirm(\'Do you really want to delete '. $display .'\');">
		<img src="../img/b_drop.png"  border="0" class="cursorStyle" title="'.('Remove').'">
		</a>' ;

	}
	*/
	function makeImageDelete( $link = "" , $display ='')
	{

		return ' 
		<img src="../images/b_delete.gif"  border="0" width=20 height=20 class="cursorStyle" title="'.('Remove').'">' ;

	}
	/**
	 * constructs an edit button code
	 *
	 * @param unknown_type $link
	 * @return unknown
	 */
	function makeCellEdit( $link = "" , $onclick = "" )
	{

		return
		'<a href="'.$link.'"  onclick="'.$onclick .'">
			<img src="../img/'.$this->editImg.'" width="20" height="20" border="0" class="cursorStyle" title="'.('Edit').'">
			</a>';

	}
	function makeImageEdit( $title = 'Edit')
	{

		return
		'
			<img src="../images/'.$this->editImg.'" border="0" class="cursorStyle" title="'.($title).'">
			';

	} 
 
	
	function makeQuantityField( $id, $value, $price)
	{

		return
		"
			<input type=text name='quantity[$id]'  value='$value' onchange=\"recalculate_price('$id', this.value, '$price');\"  onkeypress=\"return isNumberKey(event)\" title=\"leave empty or put 0 to cancel purchasing this item\">
		";

	}
	function makeradiostatus( $id , $value)
	{
	 return  "<input type=radio name='status$id' value='".pending."' ". ($value == pending? "checked" : "") ."  onclick=\"change_status('$id', this.value);\"> Pending" .
	  "<input type=radio name='status$id' value='".paid."' ". ($value == paid? "checked" : "") ."  onclick=\"change_status('$id', this.value);\">Paid<br>" .
	  "<input type=radio name='status$id' value='".delivered."' ". ($value == delivered? "checked" : "") ."  onclick=\"change_status('$id', this.value);\">Delivered" .
	 "<input type=radio name='status$id' value='".canceled."' ". ($value == canceled? "checked" : "") ."  onclick=\"change_status('$id', this.value);\">Canceled" ;
	}

 public function head($code,$version,$title)
 {
	 	$head1="<br><table class='bold'>
				<tr>
				<td  colspan=2  width='20% ' class='bordered'>مدارس المبرات
				</br>مجلس المؤسسات التعليمية
				مدرسة/ثانوية<br><input type=text name=colege id=colege size=10 class='wide' value='".Faculty."' readonly >
				</td> 
				<td width='70%' class='bordered alignC'>باسمه تعالى</td> 
				<td width='10%' rowspan=2 class='bordered' > <img src='../img/AlmabarratLogo.png' title='Logo'></img> </td>
				</tr>
				
				<tr>
				<td class='bordered'> الرمز:$code</td>
				<td class='bordered'> الاصدار:$version</td>
				<td  class='bordered alignC'>$title</td>
				
				</tr>
			</table>";
	     echo($head1);
	 	
 }
}

?>