function openAddR() {

	document.getElementById("add_rev").style.display = "block";
}

function pan_adm(k) {
	document.getElementsByClassName("pan_btn")[k].style.border = "2px solid #da1717";
	document.getElementsByClassName("adm_body")[k].style.display = "block";
	window.sessionStorage.setItem('pan_btn', k);
	window.sessionStorage.setItem('adm_body', k);
	i = 0;
	for (i = 0; i < 6; i++) {
		if (i == k) continue;
		else {
			document.getElementsByClassName("pan_btn")[i].style.border = "2px solid #FFFFFF";
			document.getElementsByClassName("adm_body")[i].style.display = "none";
		}
	}
}





function contReg(code) {
	document.getElementsByClassName("regCont")[code].style.display = "block";
	if (code == 0) {
		document.getElementsByClassName("regCont")[1].style.display = "none";
		document.getElementById("vh").style.borderBottomColor = "#f73a3a";
		document.getElementById("reg").style.borderBottomColor = "";
	}
	else {
		document.getElementsByClassName("regCont")[0].style.display = "none";
		document.getElementById("reg").style.borderBottomColor = "#f73a3a";
		document.getElementById("vh").style.borderBottomColor = "";
	}
}

function usl_ch(code) {
	document.getElementsByClassName("circ")[code].style.background = "#f73a3a";
	document.getElementsByClassName("pod")[code].style.color = "#ffffff";
	document.getElementsByClassName("desc")[code].style.display = "block";

	var i = 0;
	for (i = 0; i < 6; i++) {
		if (i != code) {
			document.getElementsByClassName("circ")[i].style.background = "";
			document.getElementsByClassName("pod")[i].style.color = "";
			document.getElementsByClassName("desc")[i].style.display = "none";
		}
	}
}


