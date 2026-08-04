<?php
if(@@sw_rel2 != 'PASA'){
	@@grid_historia_familiar = array();

	@@grid_historia_familiar[1]['frm_parentesco'] = "Padre";
	@@grid_historia_familiar[2]['frm_parentesco'] = "Madre";
	@@grid_historia_familiar[1]['frm_parentesco_label'] = "Padre";
	@@grid_historia_familiar[2]['frm_parentesco_label'] = "Madre";
	@@grid_historia_familiar[3]['frm_parentesco'] = "Hermano";
	@@grid_historia_familiar[3]['frm_parentesco_label'] = "Hermano";	
	@@grid_historia_familiar[4]['frm_parentesco'] = "Hermano";
	@@grid_historia_familiar[4]['frm_parentesco_label'] = "Hermano";		
	@@sw_rel2 = 'PASA';
}