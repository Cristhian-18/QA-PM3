<?php
if (isset(@=grid_historia_familiar) and is_array(@=grid_historia_familiar)) {

   @=grid_vivo = array();
   @=grid_fallecido = array();

   for ($i = 1; $i <= count(@=grid_historia_familiar); $i++) {


	   if(@=grid_historia_familiar[$i]['frm_familiar_vive'] == "VIVO"){

		@@grid_vivo[$i]['frm_parentesco'] = @=grid_historia_familiar[$i]['frm_parentesco'];
		@@grid_vivo[$i]['frm_edad_actual'] = @=grid_historia_familiar[$i]['frm_edad_actual'];
		@@grid_vivo[$i]['frm_enfermedades'] = @=grid_historia_familiar[$i]['frm_enfermedades'];

		$frm_edad_diagnostico = @=grid_historia_familiar[$i]['frm_edad_diagnostico'] ;
//		$frm_edad_diagnostico = @=grid_vivo[$i]['frm_edad_diagnostico'] ;
		@@grid_vivo[$i]['frm_edad_diagnostico'] = vacioNoAplica( $frm_edad_diagnostico );

	   }

	   if(@=grid_historia_familiar[$i]['frm_familiar_vive'] == "FALLECIDO"){

		@@grid_fallecido[$i]['frm_parentesco'] = @=grid_historia_familiar[$i]['frm_parentesco'];
		@@grid_fallecido[$i]['frm_edad_morir'] = @=grid_historia_familiar[$i]['frm_edad_morir'];
		@@grid_fallecido[$i]['frm_causa_muerte'] = @=grid_historia_familiar[$i]['frm_causa_muerte'];
		@@grid_fallecido[$i]['frm_diagnostico'] = @=grid_historia_familiar[$i]['frm_diagnostico'];

	   }


   }
}

