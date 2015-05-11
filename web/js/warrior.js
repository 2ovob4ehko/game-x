function Warrior (id,x,y,clas,quantity,wound,flag,step,ctx,move){
	this.id=id;
	this.x=x;
	this.y=y;
	this.clas=clas;
	this.quantity=quantity;
	this.wound=wound;
	this.flag=flag;
	this.step=step;
	this.rotation=Math.round(Math.random()*7);
	this.own=false;
	this.tired=0;
	this.ctx=ctx;
	this.move=move;
	this.draw=drawW;
	this.setRotation=setRotation;
	this.setOwn=setOwn;
	this.selectUnit=selectUnit;
	this.goToGoal=goToGoal;
	this.clash=clash;
}
function drawW(){
	var cordX=iso((this.x-1)*this.step+this.move,(this.y-1)*this.step-this.move).x;
	var cordY=iso((this.x-1)*this.step+this.move,(this.y-1)*this.step-this.move).y;
	this.ctx.drawImage(this.clas.img,0,150*this.rotation,150,150,cordX-75,cordY-65,150,150);
	this.ctx.strokeStyle=this.flag;
	this.ctx.fillStyle='#ffba25';
	this.ctx.beginPath();
	this.ctx.arc(cordX+30,cordY+37,10,0,2*Math.PI);
	this.ctx.closePath();
	this.ctx.lineWidth = 2;
	this.ctx.fill();
	this.ctx.stroke();
	this.ctx.fillStyle='#ff4225';
	this.ctx.beginPath();
	this.ctx.arc(cordX+30,cordY+12,10,0,2*Math.PI);
	this.ctx.closePath();
	this.ctx.fill();
	this.ctx.stroke();
	this.ctx.textAlign="center";
	this.ctx.fillStyle='#000000';
	this.ctx.font="14px Georgia";
	this.ctx.fillText(this.quantity,cordX+30,cordY+41);
	this.ctx.fillText(this.clas.lengthGo-this.tired,cordX+30,cordY+15);
}
function setRotation(rotation){
	this.rotation=rotation;
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
function clash(target){
	var xDistance=target.x-this.x;
	var yDistance=target.y-this.y;
	var dist=Math.round(Math.sqrt(xDistance*xDistance+yDistance*yDistance));
	if(this.clas.lengthAttack>=dist){
		var num_mod = this.quantity;
		var attack_mod = Math.pow((1+this.clas.power/100),2.5);
		var defense_mod = 1/Math.pow((1+target.clas.defense/100),2.5);
		var base_eff = this.clas.power*this.quantity;
		var base_health = target.quantity*target.clas.health+target.wound;
		var power_mod = (this.quantity*this.clas.health)/base_health;
		var final_eff = base_eff*num_mod*attack_mod*defense_mod*power_mod;
		target.quantity=Math.floor((base_health-final_eff)/target.clas.health);
		target.wound=Math.floor((base_health-final_eff)%target.clas.health);
		if(target.quantity<=0){
			return 1;
		}else return 2;
	}else return 3;
}
function goToGoal(xGoal,yGoal){
	var xDistance = xGoal - this.x;
	var yDistance = yGoal - this.y;
	var dist=Math.round(Math.sqrt(xDistance*xDistance+yDistance*yDistance));
	console.log('Дистанція '+dist);
	if((this.clas.lengthGo-this.tired-dist)<0){
		return false;
	}else{
		this.tired+=dist;
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
		if(this.own){
			this.x=xGoal;
			this.y=yGoal;
		}
		return true;
	}
}
