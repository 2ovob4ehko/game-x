function Hero (id,x,y,goal_x,goal_y,img,step,title,flag,ctx,move){
	this.id=id;
	this.x=x;
	this.y=y;
	this.title=title;
	this.flag=flag;
	this.step=step;
	this.rotation=Math.round(Math.random()*7);
	this.speed=5000;
	this.img=img;
	this.own=false;
	this.ctx=ctx;
	this.move=move;
	this.goal={x:goal_x,y:goal_y};
	this.haveTarget=false;
	this.draw=drawH;
	this.setRotation=setRotation;
	this.setGoal=setGoal;
	this.setOwn=setOwn;
	this.selectUnit=selectUnit;
	this.goToGoal=goToGoal;
	this.checkHaveTarget=checkHaveTarget;
	this.targetCell=targetCell;
}
function drawH(){
	var cordX=iso((this.x-1)*this.step+this.move,(this.y-1)*this.step-this.move).x;
	var cordY=iso((this.x-1)*this.step+this.move,(this.y-1)*this.step-this.move).y;
	this.ctx.drawImage(this.img,0,150*this.rotation,150,150,cordX-75,cordY-65,150,150);
	this.ctx.textAlign="center";
	this.ctx.fillStyle='#ffffff';
	this.ctx.font="14px Georgia";
	this.ctx.fillText(this.title,cordX+1,cordY-23);
	this.ctx.strokeStyle="#000000";
	this.ctx.beginPath();
	this.ctx.moveTo(cordX+30,cordY+37);
	this.ctx.lineTo(cordX+30,cordY+17);
	this.ctx.closePath();
	this.ctx.fillStyle=this.flag;
	this.ctx.fillRect(cordX+30,cordY+17,15,10);
	this.ctx.stroke();
}
function setRotation(rotation){
	this.rotation=rotation;
}
function setGoal(x,y){
	this.goal={x:x,y:y};
}
function setOwn(){
	this.own=true;
}
function selectUnit(img,frame){
	var w=80;
	var h=52;
	var cordX=iso((this.x-1)*this.step+this.move,(this.y-1)*this.step-this.move).x;
	var cordY=iso((this.x-1)*this.step+this.move,(this.y-1)*this.step-this.move).y;
	ctx.drawImage(img,0+w*frame,0,w,h,cordX-40,cordY+7,w,h);
}
function targetCell(img,frame){
	var w=80;
	var h=52;
	cordX=iso((this.goal.x-1)*this.step+this.move,(this.goal.y-1)*this.step-this.move).x;
	cordY=iso((this.goal.x-1)*this.step+this.move,(this.goal.y-1)*this.step-this.move).y;
	ctx.drawImage(img,0+w*frame,0,w,h,cordX-40,cordY+7,w,h);
}
function checkHaveTarget(){
	var xDistance = this.goal.x - this.x;
	var yDistance = this.goal.y - this.y;
	var dist=Math.sqrt(xDistance*xDistance+yDistance*yDistance);
	if(dist>0){this.haveTarget=true;}else{this.haveTarget=false;}
}
function goToGoal(shema){
	var xDistance = this.goal.x - this.x;
	var yDistance = this.goal.y - this.y;
	if(this.own){
		if((xDistance>0)&&(yDistance==0)){
			this.rotation=2;
			this.x++;
		}else if((xDistance<0)&&(yDistance==0)){
			this.rotation=6;
			this.x--;
		}else if((yDistance>0)&&(xDistance==0)){
			this.rotation=0;
			this.y++;
		}else if((yDistance<0)&&(xDistance==0)){
			this.rotation=4;
			this.y--;
		}else if((xDistance>0)&&(yDistance>0)){
			this.rotation=1;
			this.x++;
			this.y++;
		}else if((xDistance>0)&&(yDistance<0)){
			this.rotation=3;
			this.x++;
			this.y--;
		}else if((xDistance<0)&&(yDistance<0)){
			this.rotation=5;
			this.x--;
			this.y--;
		}else if((xDistance<0)&&(yDistance>0)){
			this.rotation=7;
			this.x--;
			this.y++;
		}
	}else{
		if((xDistance>0)&&(yDistance==0)){
			this.rotation=2;
		}else if((xDistance<0)&&(yDistance==0)){
			this.rotation=6;
		}else if((yDistance>0)&&(xDistance==0)){
			this.rotation=0;
		}else if((yDistance<0)&&(xDistance==0)){
			this.rotation=4;
		}else if((xDistance>0)&&(yDistance>0)){
			this.rotation=1;
		}else if((xDistance>0)&&(yDistance<0)){
			this.rotation=3;
		}else if((xDistance<0)&&(yDistance<0)){
			this.rotation=5;
		}else if((xDistance<0)&&(yDistance>0)){
			this.rotation=7;
		}
	}
	if(shema[this.y-1][this.x-1]==1){
		this.speed=1000;
	}else if (shema[this.y-1][this.x-1]==2){
		this.speed=5000;
	}else{
		this.speed=10000;
	}
}
