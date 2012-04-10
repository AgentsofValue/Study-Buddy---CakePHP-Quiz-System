$(document).ready(function() {
				$('#btnAdd').click(function() {
					var num     = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
					var currentInputNum  = new Number(num + 1);      // the numeric ID of the new input field being added
	 
					 // create the new element via clone(), and manipulate it's ID using currentInputNum value
					var newElem = $('#input' + (currentInputNum)).clone().attr('id', 'input' + (currentInputNum+1));
	 
					// manipulate the name/id values of the input inside the new element
					newElem.children(':first').attr('id', 'admin').attr('name', 'data[Choice][' + (currentInputNum+1)+']').attr('style',"display: inline;");
					
					// insert the new element after the last "duplicatable" input field
					$('#input' + ((currentInputNum))).after(newElem);
	 
					// enable the "remove" button
					$('#btnDel').attr('disabled','');
	 
					
				});
	 
				$('#btnDel').click(function() {
					var num = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
					var currentInputNum  = new Number(num + 1); 
					$('#input' + (currentInputNum)).remove();     // remove the last element
	 
					// enable the "add" button
					$('#btnAdd').attr('disabled','');
	 
					// if only one element remains, disable the "remove" button
					if (num-1 == 1)
						$('#btnDel').attr('disabled','disabled');
				});
	 
				$('#btnDel').attr('disabled','disabled');
			});