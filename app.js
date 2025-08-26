function portal()
{	let TK=`
	<header>
		<nav>
			<a style="background-image:url('res/logo.png');" onclick="inicio()"></a>
			<h2></h2>
			<a onclick="inicio()">Inicio</a>
			<a onclick="planes()">Planes</a>
			<a onclick="nosotros()">Nosotros</a>
			<a onclick="login()">Ingresar</a>
			<button  class='axico421 axcelshow'  onclick="axlaymen('ML')"></button>
		</nav>
	</header>
	<main  id='C2'>
	</main>
	<footer>
		<section  id='V1'  class='axwinmax'>
			<article>
				<aside>
					<h2></h2>
					<a  class='axico76'  onclick="axwinclose('V1')"></a>
				</aside>
				<div id='V1C'>
				</div>
			</article>
		</section>

		<section  id='V2'  class='axwinmed'>
			<article>
				<aside>
					<h2></h2>
					<a  class='axico76'  onclick="axwinclose('V2')"></a>
				</aside>
				<div id='V2C'>
				</div>
			</article>
		</section>
	</footer>`;
	axload('C1',TK);
	inicio();
}

function inicio()
{	let TK=`
	<section class="axslidermin">
		<article class="swiper-wrapper">
			<div class="swiper-slide"  style="background-image:url('res/ban1.jpg');"></div>
			<div class="swiper-slide"  style="background-image:url('res/ban2.jpg');"></div>
			<div class="swiper-slide"  style="background-image:url('res/ban3.jpg');"></div>
			<div class="swiper-slide"  style="background-image:url('res/ban4.jpg');"></div>
		</article>
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
		<div class="swiper-pagination"></div>
	</section>

	<section  class='axw-c'>
		<section  class='axcardmin'>
			<article>
				<figure  style="background-image:url('res/cua1.jpg');">
					<a  class='axico78'></a>
				</figure>
				<a>Cardio</a>
			</article>
			<article>
				<figure  style="background-image:url('res/cua2.jpg');">
					<a  class='axico78'></a>
				</figure>
				<a>Pesas</a>
			</article>
		</section>

		<center  class='axtitle'>Planes</center>
		<section id='P1' class='axpalmin'>
			<nav>
				<a onclick="axpalact('P1',this,1)" class='act'>Mensual</a>
				<a onclick="axpalact('P1',this,2)">Ejecutivo</a>
				<a onclick="axpalact('P1',this,3)">Maquinas</a>
			</nav>
			<article>
				<palconte class='act'>
					<center  class='axtitle'>Contenido paleta 1</center>
				</palconte>
				<palconte>
					<center  class='axtitle'>Contenido paleta 2</center>
				</palconte>
				<palconte>
					<center  class='axtitle'>Contenido paleta 3</center>
				</palconte>
			</article>
		</section>
	</section>`;
	axload('C2',TK);
	axslideract('axslidermin');
}

function nosotros()
{	let TK=`
	<center  class='axtitle'>Nosotros</center>`;
	axload('C2',TK);
}

function planes()
{	let TK=`
	<center  class='axtitle'>Planes</center>`;
	axload('C2',TK);
}

function login()
{	axwinopen('V2');
	let TK=`
	<form  id='F7'  class='axfrmmin'>
		<center>Autoidentificacion</center>
		<figure  style="background-image:url('res/logo.png');"></figure>
		<label>Carnet</label>
		<input name='ci'  type='text'  required>
		<label>Contra</label>
		<input name='pwd'    type='password'>
		<section>
			<article>
				<button>Ingresar</button>
			</article>
			<article>
				<button type='button' onclick="userfrm()">Registro</button>
			</article>
		</section>
	</form>
	<section  id='C2'></section>`;
	axload('V2C',TK);
	axelem('F7').addEventListener('submit',async e=>
	{	e.preventDefault();
		let data=await axdatapost(`api/login`,'F7');
		console.log(data);
		if(data.resp)
		{	axtokenset(data.num,`${data.nom} ${data.ap}`,'',[data.tipo]);
			cuenta();
			axmsgmin(data.msg);
		}
		else
		{	axmsgerr('Contra incorrecta');
		}
	});
}

async function panel()
{	let data=await axdataget(`api/panel`);
	console.log(data);
	let TK=`
	<center  class='axtitle'>Panel principal</center>
	<section  class='axcardtin'>
		<article>
			<h3>${data.mays}</h3>
			<p>Mayores de edad</p>
		</article>
		<article>
			<h3>${data.mens}</h3>
			<p>Menores de edad</p>
		</article>
	</section>
	<section  class='axsec'> 
		<article id='G1'></article>
		<article id='G2'></article>
	</section>`;
	axload('C2',TK);

	M=[
		['Masculino',Number(data.list[1].cant)],
		['Femenino',Number(data.list[0].cant)],
		['Ninguno',Number(data.list[2].cant)]
	];
	axgracake('G1','Genero','cantidad',M);

	M=[];
	for(P=0; P<data.tipos.length; P++)
	{	M.push([data.tipos[P].tipo,Number(data.tipos[P].cant)]);	}
	console.log(M);
	axgrabar('G2','Tipos de libro','cantidad',M);
}

function cuenta()
{	let tipo=axtokenget('aud')[0];
	let TK=`
	<header>
		<nav>
			<a>Lista de personas</a>
			<h2></h2>
			<button  class='axico421 axcelshow'  onclick="axlaymen('ML')"></button>
		</nav>
	</header>
	<main>
		<section class='axsec'>
			<nav  class='axmenmax' id='ML'>
				<article>
					<h2>${axtokenget('name')}</h2>
				</article>
				<center>${tipo}</center>
				<a onclick="panel()">Panel</a>
				<a onclick="reportes()">Reportes</a>`;
				if(tipo=='Admin')
					{ TK+=`
						<a onclick="planeslist()">Registrar plan</a>
						<a onclick="userfrm()">Registrar personas</a>
						<a onclick="excellist1()">Leer excel 1</a>`; }
				TK+=`
				<a onclick="userlist()">Lista de personas</a>
				<a onclick="axtokendel('index.html')">Cerrar sesion</a>
			</nav>
			<article  id='C2'>
					<center  class='axtitle'>Bienvenido</center>
			</article>
		</section>
	</main>
	<footer>
		<section  id='V1'  class='axwinmed'>
			<article>
				<aside>
					<h2></h2>
					<a  class='axico76'  onclick="axwinclose('V1')"></a>
				</aside>
				<div  id='V1C'>
				</div>
			</article>
		</section>
		<section  id='V2'  class='axwinmed'>
			<article>
				<aside>
					<h2></h2>
					<a  class='axico76'  onclick="axwinclose('V2')"></a>
				</aside>
				<div  id='V2C'>
				</div>
			</article>
		</section>
	</footer>`;
	axload('C1',TK);
}

function reportes()
{	let TK=`
	<center  class='axtitle'>Reportes</center>
	<a  class='axbotmed'  href="api/reporte3.php" target="new">Carta</a>
	<a  class='axbotmed'  href="api/reporte6.php" target="new">Imprimir certificados</a>
	<hr>
	<a  class='axbotmed'  href="api/reportexls1.php" target="new">Excel 1</a>
	<a  class='axbotmed'  href="api/reportexls2.php" target="new">Excel 2</a>
	<a  class='axbotmed'  href="api/reportexls3.php" target="new">Excel 3</a>
	`;
	axload('C2',TK);
}

function userfrm()
{	axwinopen('V2');
	let TK=`
	<form  id='F1'  class='axfrmmed'>
		<center>Registro de persona</center>
		<section>
			<article>
				<input  name='nom'   placeholder='Nombres'    required>
			</article>
			<article>
				<input  name='ap'    placeholder='Apellidos'  required>
			</article>
		</section>
		<input  name='ci'   placeholder='Carnet'     type='text' required>
		<input  name='pwd'  placeholder='Contraseña' type='password'>
		<button>Enviar</button>
	</form>`;
	axload('V2C',TK);
	axelem('F1').addEventListener('submit',async e=>
	{	e.preventDefault();
		let data=await axdatapost(`api/usersave`,'F1');
		if(data.resp)
		{	axmsgok('Se guardo');
			axelem('F1').reset();
		}
		else
		{	axmsgerr('No se envio');	}
	})
}

async function useredit(num)
{	let data=await axdataget(`api/personinfo/${num}`);
	console.log(data);
	let TK=`
	<section class="axslidepost">
		<article class="swiper-wrapper">`;
			for(P=0; P<data.fots.length; P++)
			{	TK+=`
				<aside class="swiper-slide">
					<figure  style="background-image:url('${data.fots[P].url}');"></figure>
				</aside>`;
			}
			TK+=`
		</article>
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
	</section>
	<form  id='F6'  class='axfrmmed' enctype="multipart/form-data">
		<input name='num' value='${num}'  type='hidden'>
		<label>Subir imagenes</label>
		<input name='arch[]' type='file'  accept='.jpg'  multiple>
		<button>Enviar</button>
	</form>
	<form  id='F2'  class='axfrmmed'>
		<center>Editar persona</center>
		<input  name='num'   value='${data.num}'  type='hidden'>
		<input  name='nom'   value='${data.nom}'   placeholder='Nombres'    required>
		<input  name='ap'    value='${data.ap}'    placeholder='Apellidos'  required>
		<input  name='email' value='${data.email}' placeholder='Email'      type='email' required>
		<input  name='pwd'   value='${data.pwd}'   placeholder='Contraseña' type='password'>
		<select name='tipo'>
			<option  ${data.tipo=='Gerente'?'selected':''}>Gerente</option>
			<option  ${data.tipo=='Contador'?'selected':''}>Contador</option>
			<option  ${data.tipo=='Pasante'?'selected':''}>Pasante</option>
		</select>
		<button>Aplicar cambios</button>
	</form>`;
	axload('C2',TK);

	axslideract('axslidepost');

	axelem('F2').addEventListener('submit',async e=>
	{	e.preventDefault();
		let data=await axdatapost(`api/personup`,'F2');
		if(data.resp)
		{	axmsgok('Se guardo');	}
		else
		{	axmsgerr('No se envio');	}
	})

	axelem('F6').addEventListener('submit',async e=>
	{	e.preventDefault();
		let data=await axdatapost(`api/personfotsave`,'F6');
		if(data.resp)
		{	axmsgok('Se guardo');	}
		else
		{	axmsgerr('No se envio');	}
	})
}

async function planeslist()
{	let data=await axdataget(`api/planeslist`);
	console.log(data);
	let TK=`
	<center  class='axtitle'>Lista de planes</center>
	<section id='LISTPLAN' style="border:1px solid red;">`;
		for(P=0; P<data.list.length; P++)
		{	TK+=`
			<section  id='PLANES${data.list[P].nump}'  class='axtitlemin'>
				<h2 class='axa-l'>${data.list[P].nomp} (${data.list[P].prec} Bs)</h2>
				<a class='axico135'  on click="planesdel{data.list[P].nump})"></a>
				</section>`;
		}
		TK+=`
	</section>
	<form id='F8'	class='axfrmmin'>
		<center>Nuevo plan</center>
		<input name='nomp'	type='text'		placeholder='Nombre del plan'>
		<input name='prec'	type='number'	placeholder='Precio'>
		<textarea	name='des' placeholder='Descripcion'></textarea>
		<button>Insertar</button>
	</form>`;
	axload('C2',TK);
	axelem('F8').addEventListener('submit',async e=>
	{
		e.preventDefault();
		let data=await axdatapost(`api/planessave`,'F8');
		if(data.resp)
		{
			axmsgok('Datos guardados');
		
			let TK=`
			<section id='PLANES${data.nump}' class='axtitlemin'>
				<h2 class='axa-1'>${data.nomp} (${data.prec} Bs)</h2>
				<a class='axico135' onclick="planesdel(${data.nump})"></a>
			</section>`;
			axloadadd('LISTPLAN',TK);
			axelem('F8').reset();
		}
		else
		{
			axmsgerr('No se guardo los datos');
		}
	})
}

async function userlist()
{	let tipo=axtokenget('aud')[0];
	let data=await axdataget(`api/userlist`);
	console.log(data);
	let TK=`
	<center  class='axtitle'>Lista de personas</center>`;
	for(P=0; P<data.list.length; P++)
	{	TK+=`
		<section  id='PERSON${data.list[P].num}'  class='axtitlemin'>
			<h2 class='axa-l'>${data.list[P].nom}</h2>
			<a  class='axico296'  href="api/reporte7.php?x=${data.list[P].num}"  target="new"></a>`;
			if(tipo=='Gerente')
			{	TK+=`
				<a  class='axico135'  onclick="persondel(${data.list[P].num})"></a>
				<a  class='axico131'  onclick="personedit(${data.list[P].num})"></a>`;
			}
			TK+=`
		</section>`;
	}
	axload('C2',TK);
}

function userdel(num)
{	axmsgconfirm('Estas seguro de eliminar')
	.then(async res=>
	{	if(res)
		{	let data=await axdataget(`api/persondel/${num}`);
			if(data.resp)
			{	axmsgmin('Se elimino');
				axelemhide(`PERSON${num}`);
			}
			else
			{	axmsgerr('No se elimino');	}
		}
	})
}

async function userselect(ide,cap,busq)
{	axwinopen('V1');
	axpreloadmin('V1C');
	let data=await axdataget(`api/personlist`);
	console.log(data);
	let TK=`
	<form  class='axbarmed'>
		<input>
	</form>`;
	for(P=0; P<data.list.length; P++)
	{	TK+=`
		<section  class='axlistmed'>
			<article>
				<h2 onclick="axelem('${ide}').value='${data.list[P].num}';  axelem('${cap}').innerHTML='${data.list[P].nom}'; axwinclose('V1'); ">${data.list[P].ap} ${data.list[P].nom}</h2>
			</article>
		</section>`;
	}
	axload('V1C',TK);
}

async function excellist1()
{	
	let data= await axdataget(`api/excellist1`);
	console.log(data);
	let TK=`
	<center class='sctitle'>Lista del Excel</center>`;
	if(data.resp)
		{
			for(P=0; P<data.list.length;P++)
			{
				TK+=`
				<section class='axtitlemin'>
					<aside>
						<h2>${data.list[P].nom} ${data.list[P].ap}</h2>
						<h3>Carnet: ${data.list[P].ci}</h3>
				</section>`;
			}
			axload('C2',TK);
		}
	else
		{

		}	
}