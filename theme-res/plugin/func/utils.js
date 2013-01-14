Function.prototype.flag = function(pNum){
	if ( pNum !== undefined ){
		this.flagNum = pNum;
	}else{
		--this.flagNum;
	}
	if ( this.flagNum == 0 ){
		this.call();
	}
	// Function.prototype.flag 
}
