<?php
class Parametros_ladaenlaces
{
    private $ref_sisa;
	private $punta;
	private $arrays=array();
	
	public function __construct(
	    $array_columna=array
		(
"columna_0"=>"id", 
"columna_1"=>"num_ot_frida", 
"columna_2"=>"fase", 
"columna_3"=>"ref_sisa", 
"columna_4"=>"ref_sisa_con", 
"columna_5"=>"ref_sisa_pro", 
"columna_6"=>"etapa_sisa", 
"columna_7"=>"etapa_sisa_conv", 
"columna_8"=>"id_telcel", 
"columna_9"=>"rnc", 
"columna_10"=>"rnc_nombre", 
"columna_11"=>"tipo_ref", 
"columna_12"=>"tipo_trabajo", 
"columna_13"=>"tipo_producto", 
"columna_14"=>"tipo_proyecto", 
"columna_15"=>"tipo_servicio", 
"columna_16"=>"trafico", 
"columna_17"=>"tipo_transporte", 
"columna_18"=>"tipo_perfil", 
"columna_19"=>"perfil_qos", 
"columna_20"=>"tipo_topologico", 
"columna_21"=>"velocidad_transporte", 
"columna_22"=>"clase_servicio", 
"columna_23"=>"tipo_solicitud", 
"columna_24"=>"descripcion_solicitud", 
"columna_25"=>"cliente_sisa", 
"columna_26"=>"cliente_comun", 
"columna_27"=>"division", 
"columna_28"=>"division_b", 
"columna_29"=>"poblacion", 
"columna_30"=>"poblacion_b", 
"columna_31"=>"region_telcel", 
"columna_32"=>"ciudad", 
"columna_33"=>"ciudad_b", 
"columna_34"=>"estado", 
"columna_35"=>"estado_b", 
"columna_36"=>"area", 
"columna_37"=>"area_b", 
"columna_38"=>"siglas_central", 
"columna_39"=>"siglas_central_b", 
"columna_40"=>"central", 
"columna_41"=>"central_b", 
"columna_42"=>"cm", 
"columna_43"=>"cm_b", 
"columna_44"=>"car", 
"columna_45"=>"ancho_banda", 
"columna_46"=>"c_vlan_gestion", 
"columna_47"=>"fecha_c_vlan_gestion", 
"columna_48"=>"ch_c_vlan_gestion", 
"columna_49"=>"c_vlan_gestion_dde", 
"columna_50"=>"c_vlan_gestion_rnc", 
"columna_51"=>"vlan_cfm", 
"columna_52"=>"vlan_hk", 
"columna_53"=>"x_vlan", 
"columna_54"=>"vlan_wdm", 
"columna_55"=>"s_vlan_tx", 
"columna_56"=>"ch_s_vlan_tx", 
"columna_57"=>"fecha_s_vlan_tx", 
"columna_58"=>"ot_adva_ld", 
"columna_59"=>"num_intervencion_top", 
"columna_60"=>"estatus_top", 
"columna_61"=>"fecha_solicitud_top", 
"columna_62"=>"fecha_estatus_top", 
"columna_63"=>"observaciones_top", 
"columna_64"=>"ch_matriz_traf_top", 
"columna_65"=>"fecha_matriz_traf_top", 
"columna_66"=>"ch_expins", 
"columna_67"=>"fecha_expins", 
"columna_68"=>"construccion_sdh", 
"columna_69"=>"observaciones_sdh", 
"columna_70"=>"fecha_construccion_sdh", 
"columna_71"=>"login_construccion_sdh", 
"columna_72"=>"pruebas_pto", 
"columna_73"=>"observaciones_pto", 
"columna_74"=>"fecha_construccion_pto", 
"columna_75"=>"login_construccion_pto", 
"columna_76"=>"ch_clli_adva", 
"columna_77"=>"fecha_clli_adva", 
"columna_78"=>"estatus_cns1_top", 
"columna_79"=>"causa_top", 
"columna_80"=>"observaciones_cns1_top", 
"columna_81"=>"fecha_estatus_cns1_top", 
"columna_82"=>"fecha_solicitud_cns1_top", 
"columna_83"=>"estatus_pba", 
"columna_84"=>"causa_pba", 
"columna_85"=>"observaciones_pba", 
"columna_86"=>"fecha_estatus_pba", 
"columna_87"=>"fecha_solicitud_pba", 
"columna_88"=>"ch_archivos_pba", 
"columna_89"=>"ch_ges_vlan_servicio", 
"columna_90"=>"ch_intx_rcdt", 
"columna_91"=>"ch_ges_pex", 
"columna_92"=>"ch_ges_rb", 
"columna_93"=>"ch_ges_rnc", 
"columna_94"=>"ch_inx_cliente", 
"columna_95"=>"login", 
"columna_96"=>"fecha_alta", 
"columna_97"=>"fecha_operacion", 
"columna_98"=>"porndeodden", 
"columna_99"=>"ch_cns_top", 
"columna_100"=>"cpe_rb", 
"columna_101"=>"ch_sitio_rb", 
"columna_102"=>"ch_fo_rb", 
"columna_103"=>"ch_fo_rb_avance", 
"columna_104"=>"ch_fo_rb_fecha", 
"columna_105"=>"ch_fo_rb_causa", 
"columna_106"=>"ch_fo_rb_resp", 
"columna_107"=>"ch_sitio_rnc", 
"columna_108"=>"ch_ges_pex_rb", 
"columna_109"=>"ch_ges_pex_rnc", 
"columna_110"=>"ch_vlan_serv", 
"columna_111"=>"ch_cns_pba", 
"columna_112"=>"sem_fo", 
"columna_113"=>"sem_inst", 
"columna_114"=>"sem_real_rfc", 
"columna_115"=>"fecha_ch_pba", 
"columna_116"=>"con_vlan_gestion", 
"columna_117"=>"con_vlan_servicio", 
"columna_118"=>"int_pruebas_servicio", 
"columna_119"=>"ch_vlan_serv_est", 
"columna_120"=>"clasif_fo", 
"columna_121"=>"observaciones_pext", 
"columna_122"=>"observaciones_vlanserv", 
"columna_123"=>"ch_valida_vlan", 
"columna_124"=>"ch_valida_top", 
"columna_125"=>"ent_servicio", 
"columna_126"=>"cambio", 
"columna_127"=>"ref_sisa_con_ant", 
"columna_128"=>"comentarios_cns", 
"columna_129"=>"infra_1", 
"columna_130"=>"fecha_atn_infra1", 
"columna_131"=>"infra_2", 
"columna_132"=>"fecha_atn_infra2", 
"columna_133"=>"infra_3", 
"columna_134"=>"fecha_atn_infra3", 
"columna_135"=>"infra_4", 
"columna_136"=>"fecha_atn_infra4", 
"columna_137"=>"infra_5", 
"columna_138"=>"fecha_atn_infra5", 
"columna_139"=>"infra_6", 
"columna_140"=>"fecha_atn_infra6", 
"columna_141"=>"infra_7", 
"columna_142"=>"fecha_atn_infra7", 
"columna_143"=>"infra_8", 
"columna_144"=>"fecha_atn_infra8", 
"columna_145"=>"infra_9", 
"columna_146"=>"fecha_atn_infra9", 
"columna_147"=>"prioridad", 
"columna_148"=>"fecha_alta_sisa", 
"columna_149"=>"fecha_dd", 
"columna_150"=>"fecha_alta_centrales", 
"columna_151"=>"dias_sin_centrales", 
"columna_152"=>"observaciones", 
"columna_153"=>"estatus_regproy_tx", 
"columna_154"=>"observaciones_regproy_tx", 
"columna_155"=>"fecha_sol_regproy_tx", 
"columna_156"=>"fecha_atn_regproy_tx", 
"columna_157"=>"estatus_regproy_acc", 
"columna_158"=>"observaciones_regproy_acc", 
"columna_159"=>"fecha_sol_regproy_acc", 
"columna_160"=>"fecha_atn_regproy_acc", 
"columna_161"=>"estatus_valproy_tx", 
"columna_162"=>"observaciones_valproy_tx", 
"columna_163"=>"fecha_sol_valproy_tx", 
"columna_164"=>"fecha_atn_valproy_tx", 
"columna_165"=>"estatus_valproy_acc", 
"columna_166"=>"observaciones_valproy_acc", 
"columna_167"=>"fecha_sol_valproy_acc", 
"columna_168"=>"fecha_atn_valproy_acc", 
"columna_169"=>"estatus_integra_top", 
"columna_170"=>"fecha_sol_integra_top", 
"columna_171"=>"fecha_atn_integra_top", 
"columna_172"=>"observaciones_integra_top", 
"columna_173"=>"estatus_constf", 
"columna_174"=>"observaciones_constf", 
"columna_175"=>"fecha_sol_constf", 
"columna_176"=>"fecha_atn_constf", 
"columna_177"=>"estatus_valcorr", 
"columna_178"=>"observaciones_valcorr", 
"columna_179"=>"fecha_sol_valcorr", 
"columna_180"=>"fecha_atn_valcorr", 
"columna_181"=>"estatus_constl", 
"columna_182"=>"observaciones_constl", 
"columna_183"=>"fecha_sol_constl", 
"columna_184"=>"fecha_atn_constl", 
"columna_185"=>"estatus_valcc_acc", 
"columna_186"=>"observaciones_valcc_acc", 
"columna_187"=>"fecha_sol_valcc_acc", 
"columna_188"=>"fecha_atn_valcc_acc", 
"columna_189"=>"estatus_valcc_tx", 
"columna_190"=>"observaciones_valcc_tx", 
"columna_191"=>"fecha_sol_valcc_tx", 
"columna_192"=>"fecha_atn_valcc_tx", 
"columna_193"=>"estatus_otserv", 
"columna_194"=>"observaciones_otserv", 
"columna_195"=>"fecha_sol_otserv", 
"columna_196"=>"fecha_atn_otserv", 
"columna_197"=>"estatus_valsisa", 
"columna_198"=>"observaciones_valsisa", 
"columna_199"=>"fecha_sol_valsisa", 
"columna_200"=>"fecha_atn_valsisa", 
"columna_201"=>"ch_ot_acc", 
"columna_202"=>"ch_ot_tx", 
"columna_203"=>"ch_ot_ld", 
"columna_204"=>"ch_ot_servicio", 
"columna_205"=>"fecha_sol_estatus_top", 
"columna_206"=>"fecha_atn_estatus_top", 
"columna_207"=>"observaciones_estatus_top", 
"columna_208"=>"ch_ot_acc_b", 
"columna_209"=>"ch_ot_tx_b", 
"columna_210"=>"aplica_ot_acc", 
"columna_211"=>"aplica_ot_tx", 
"columna_212"=>"aplica_ot_ld", 
"columna_213"=>"ch_aproy", 
"columna_214"=>"fecha_atn_aproy", 
"columna_215"=>"ch_tirilla", 
"columna_216"=>"estatus_integra_ot", 
"columna_217"=>"recibe_infra_acc", 
"columna_218"=>"requiere_infra_cole", 
"columna_219"=>"ch_infra_cole", 
"columna_220"=>"fecha_sol_integra_ot", 
"columna_221"=>"fecha_atn_integra_ot", 
"columna_222"=>"gpo_facilidad", 
"columna_223"=>"observaciones_infra_cole", 
"columna_224"=>"clave_liq", 
"columna_225"=>"ch_liq_val_acc", 
"columna_226"=>"observaciones_integra_ot", 
"columna_227"=>"fecha_sol_s_vlan_tx", 
"columna_228"=>"fecha_atn_s_vlan_tx", 
"columna_229"=>"observaciones_s_vlan_tx", 
"columna_230"=>"infra_1_b", 
"columna_231"=>"fecha_atn_infra1_b", 
"columna_232"=>"infra_2_b", 
"columna_233"=>"fecha_atn_infra2_b", 
"columna_234"=>"infra_3_b", 
"columna_235"=>"fecha_atn_infra3_b", 
"columna_236"=>"infra_6_b", 
"columna_237"=>"fecha_atn_infra6_b", 
"columna_238"=>"infra_7_b", 
"columna_239"=>"fecha_atn_infra7_b", 
"columna_240"=>"infra_8_b", 
"columna_241"=>"fecha_atn_infra8_b", 
"columna_242"=>"infra_9_b", 
"columna_243"=>"fecha_atn_infra9_b", 
"columna_244"=>"estatus_constft", 
"columna_245"=>"observaciones_constft", 
"columna_246"=>"fecha_sol_constft", 
"columna_247"=>"fecha_atn_constft", 
"columna_248"=>"estatus_constftcolectora", 
"columna_249"=>"observaciones_constftcolectora", 
"columna_250"=>"fecha_sol_constftcolectora", 
"columna_251"=>"fecha_atn_constftcolectora", 
"columna_252"=>"estatus_constf_b", 
"columna_253"=>"observaciones_constf_b", 
"columna_254"=>"fecha_sol_constf_b", 
"columna_255"=>"fecha_atn_constf_b", 
"columna_256"=>"estatus_valcc_acc_b", 
"columna_257"=>"observaciones_valcc_acc_b", 
"columna_258"=>"fecha_sol_valcc_acc_b", 
"columna_259"=>"fecha_atn_valcc_acc_b", 
"columna_260"=>"estatus_regproy_acc_b", 
"columna_261"=>"observaciones_regproy_acc_b", 
"columna_262"=>"fecha_sol_regproy_acc_b", 
"columna_263"=>"fecha_atn_regproy_acc_b", 
"columna_264"=>"recibe_infra_tx", 
"columna_265"=>"repla", 
"columna_266"=>"tarjetala", 
"columna_267"=>"puertola", 
"columna_268"=>"tpuertola", 
"columna_269"=>"remla", 
"columna_270"=>"vc4la", 
"columna_271"=>"vc12la", 
"columna_272"=>"replb", 
"columna_273"=>"tarjetalb", 
"columna_274"=>"puertolb", 
"columna_275"=>"tpuertolb", 
"columna_276"=>"remlb", 
"columna_277"=>"vc4lb", 
"columna_278"=>"vc12lb", 
"columna_279"=>"replda", 
"columna_280"=>"tarjetalda", 
"columna_281"=>"puertolda", 
"columna_282"=>"tpuertolda", 
"columna_283"=>"remlda", 
"columna_284"=>"vc4lda", 
"columna_285"=>"vc12lda", 
"columna_286"=>"repldb", 
"columna_287"=>"tarjetaldb", 
"columna_288"=>"puertoldb", 
"columna_289"=>"tpuertoldb", 
"columna_290"=>"remldb", 
"columna_291"=>"vc4ldb", 
"columna_292"=>"vc12ldb", 
"columna_293"=>"ch_aproy_b", 
"columna_294"=>"fecha_atn_aproy_b", 
"columna_295"=>"fecha_sol_aproy_b", 
"columna_296"=>"estatus_rep_equ_acc", 
"columna_297"=>"estatus_rep_equ_tx", 
"columna_298"=>"observaciones_rep_equ_acc", 
"columna_299"=>"observaciones_rep_equ_tx", 
"columna_300"=>"fecha_sol_rep_equ_acc", 
"columna_301"=>"fecha_atn_rep_equ_acc", 
"columna_302"=>"fecha_sol_rep_equ_tx", 
"columna_303"=>"fecha_atn_rep_equ_tx", 
"columna_304"=>"estatus_reg_dat", 
"columna_305"=>"estatus_reg_dat_b", 
"columna_306"=>"observaciones_reg_dat", 
"columna_307"=>"observaciones_reg_dat_b", 
"columna_308"=>"fecha_sol_reg_dat", 
"columna_309"=>"fecha_atn_reg_dat", 
"columna_310"=>"fecha_sol_reg_dat_b", 
"columna_311"=>"fecha_atn_reg_dat_b", 
"columna_312"=>"tipo_movimiento", 
"columna_313"=>"criticidad", 
"columna_314"=>"fol_ser", 
"columna_315"=>"com_n", 
"columna_316"=>"estado_sisa", 
"columna_317"=>"estatus_constft_a", 
"columna_318"=>"observaciones_constft_a", 
"columna_319"=>"fecha_sol_constft_a", 
"columna_320"=>"fecha_atn_constft_a", 
"columna_321"=>"estatus_constft_b", 
"columna_322"=>"observaciones_constft_b", 
"columna_323"=>"fecha_sol_constft_b", 
"columna_324"=>"fecha_atn_constft_b", 
"columna_325"=>"estatus_valida_top", 
"columna_326"=>"observaciones_valida_top", 
"columna_327"=>"fecha_sol_valida_top", 
"columna_328"=>"fecha_atn_valida_top", 
"columna_329"=>"estatus_constft_ld", 
"columna_330"=>"observaciones_constft_ld", 
"columna_331"=>"fecha_sol_constft_ld", 
"columna_332"=>"fecha_atn_constft_ld", 
"columna_333"=>"estatus_asigna_lp", 
"columna_334"=>"observaciones_asigna_lp", 
"columna_335"=>"fecha_sol_asigna_lp", 
"columna_336"=>"fecha_atn_asigna_lp", 
"columna_337"=>"estatus_valida_constft_ld", 
"columna_338"=>"observaciones_valida_constft_ld", 
"columna_339"=>"fecha_sol_valida_constft_ld", 
"columna_340"=>"fecha_atn_valida_constft_ld", 
"columna_341"=>"estatus_asistencia_pruebas", 
"columna_342"=>"observaciones_asistencia_pruebas", 
"columna_343"=>"fecha_sol_asistencia_pruebas", 
"columna_344"=>"fecha_atn_asistencia_pruebas", 
"columna_345"=>"estatus_valida_activa", 
"columna_346"=>"observaciones_valida_activa", 
"columna_347"=>"fecha_sol_valida_activa", 
"columna_348"=>"fecha_atn_valida_activa", 
"columna_349"=>"estatus_asistencia_pruebas_r", 
"columna_350"=>"observaciones_asistencia_pruebas_r", 
"columna_351"=>"fecha_sol_asistencia_pruebas_r", 
"columna_352"=>"fecha_atn_asistencia_pruebas_r", 
"columna_353"=>"estatus_integra_ots_serv", 
"columna_354"=>"observaciones_integra_ots_serv", 
"columna_355"=>"fecha_sol_integra_ots_serv", 
"columna_356"=>"fecha_atn_integra_ots_serv", 
"columna_357"=>"estatus_valida_medio", 
"columna_358"=>"observaciones_valida_medio", 
"columna_359"=>"fecha_sol_valida_medio", 
"columna_360"=>"fecha_atn_valida_medio", 
"columna_361"=>"material", 
"columna_362"=>"asignacion", 
"columna_363"=>"estatus_elaboracion_ot_colectora", 
"columna_364"=>"observaciones_elaboracion_ot_colectora", 
"columna_365"=>"fecha_sol_elaboracion_ot_colectora", 
"columna_366"=>"fecha_atn_elaboracion_ot_colectora", 
"columna_367"=>"estatus_entrega_serv", 
"columna_368"=>"observaciones_entrega_serv", 
"columna_369"=>"fecha_sol_entrega_serv", 
"columna_370"=>"fecha_atn_entrega_serv", 
"columna_371"=>"cm_aa", 
"columna_372"=>"cm_ab", 
"columna_373"=>"cm_ld", 
"columna_374"=>"cm_cole", 
"columna_375"=>"ch_expediente", 
"columna_376"=>"requiere_const_ld", 
"columna_377"=>"estatus_asignacion_cx", 
"columna_378"=>"fecha_sol_asignacion_cx", 
"columna_379"=>"fecha_atn_asignacion_cx", 
"columna_380"=>"observaciones_asignacion_cx", 
"columna_381"=>"estatus_elabora_ot_enru", 
"columna_382"=>"fecha_sol_elabora_ot_enru", 
"columna_383"=>"fecha_atn_elabora_ot_enru", 
"columna_384"=>"observaciones_elabora_ot_enru", 
"columna_385"=>"ch_ot_enru_sise", 
"columna_386"=>"estatus_elabora_ot_enru_b", 
"columna_387"=>"fecha_sol_elabora_ot_enru_b", 
"columna_388"=>"fecha_atn_elabora_ot_enru_b", 
"columna_389"=>"observaciones_elabora_ot_enru_b", 
"columna_390"=>"ch_ot_enru_sise_b", 
"columna_391"=>"estatus_afecta_instala", 
"columna_392"=>"fecha_sol_afecta_instala", 
"columna_393"=>"fecha_atn_afecta_instala", 
"columna_394"=>"observaciones_afecta_instala", 
"columna_395"=>"estatus_afecta_instala_b", 
"columna_396"=>"fecha_sol_afecta_instala_b", 
"columna_397"=>"fecha_atn_afecta_instala_b", 
"columna_398"=>"observaciones_afecta_instala_b", 
"columna_399"=>"estatus_proyecto_fo", 
"columna_400"=>"fecha_sol_proyecto_fo", 
"columna_401"=>"fecha_atn_proyecto_fo", 
"columna_402"=>"observaciones_proyecto_fo", 
"columna_403"=>"estatus_proyecto_fo_b", 
"columna_404"=>"fecha_sol_proyecto_fo_b", 
"columna_405"=>"fecha_atn_proyecto_fo_b", 
"columna_406"=>"observaciones_proyecto_fo_b", 
"columna_407"=>"estatus_define_nodo_ld", 
"columna_408"=>"fecha_sol_define_nodo_ld", 
"columna_409"=>"fecha_atn_define_nodo_ld", 
"columna_410"=>"observaciones_define_nodo_ld", 
"columna_411"=>"estatus_facilidad_ld", 
"columna_412"=>"fecha_sol_facilidad_ld", 
"columna_413"=>"fecha_atn_facilidad_ld", 
"columna_414"=>"observaciones_facilidad_ld", 
"columna_415"=>"ch_ot_sise", 
"columna_416"=>"ch_ot_cte_a", 
"columna_417"=>"ch_ot_cte_b", 
"columna_418"=>"ch_ot_ctrl_a", 
"columna_419"=>"ch_ot_ctrl_b", 
"columna_420"=>"estatus_revision_lp", 
"columna_421"=>"fecha_sol_revision_lp", 
"columna_422"=>"fecha_atn_revision_lp", 
"columna_423"=>"observaciones_revision_lp", 
"columna_424"=>"ch_os_comercial", 
"columna_425"=>"ch_site_survey", 
"columna_426"=>"fecha_ot_acc", 
"columna_427"=>"resp_ot_acc", 
"columna_428"=>"fecha_ot_cte_a", 
"columna_429"=>"resp_ot_cte_a", 
"columna_430"=>"fecha_ot_ctrl_a", 
"columna_431"=>"resp_ot_ctrl_a", 
"columna_432"=>"fecha_ot_acc_b", 
"columna_433"=>"resp_ot_acc_b", 
"columna_434"=>"fecha_ot_cte_b", 
"columna_435"=>"resp_ot_cte_b", 
"columna_436"=>"fecha_ot_ctrl_b", 
"columna_437"=>"resp_ot_ctrl_b", 
"columna_438"=>"fecha_infra_cole", 
"columna_439"=>"resp_infra_cole", 
"columna_440"=>"fecha_expediente", 
"columna_441"=>"resp_expediente", 
"columna_442"=>"fecha_ot_ld", 
"columna_443"=>"resp_ot_ld", 
"columna_444"=>"ip_eq_acc", 
"columna_445"=>"ip_eq_acc_b", 
"columna_446"=>"ip_fibra_optica", 
"columna_447"=>"ip_cobre_acc", 
"columna_448"=>"ip_cobre_acc_b", 
"columna_449"=>"fecha_ot_tx", 
"columna_450"=>"resp_ot_tx", 
"columna_451"=>"fecha_ot_tx_b", 
"columna_452"=>"resp_ot_tx_b", 
"columna_453"=>"ip_fibra_optica_b", 
"columna_454"=>"tipo_mov_sisa", 
"columna_455"=>"aplica_portabilidad", 
"columna_456"=>"tipo_referencia", 
"columna_457"=>"ref_sisa_asociada", 
"columna_458"=>"alcance", 
"columna_459"=>"interfaz", 
"columna_460"=>"interfaz_b", 
"columna_461"=>"multipunto", 
"columna_462"=>"material_b", 
"columna_463"=>"asignacion_b", 
"columna_464"=>"ip_analisis", 
"columna_465"=>"req_ctrl_a", 
"columna_466"=>"clli_equipo_cte", 
"columna_467"=>"slot_cte", 
"columna_468"=>"pto_cte", 
"columna_469"=>"clli_equ_ctrl", 
"columna_470"=>"slot_ctrl", 
"columna_471"=>"pto_ctrl", 
"columna_472"=>"aplica_proy_const", 
"columna_473"=>"pto_tx", 
"columna_474"=>"clli_cole", 
"columna_475"=>"slot_cole", 
"columna_476"=>"pto_cole", 
"columna_477"=>"cap_pto_cole", 
"columna_478"=>"estatus_ingenieria", 
"columna_479"=>"fecha_sol_ingenieria", 
"columna_480"=>"fecha_atn_ingenieria", 
"columna_481"=>"observaciones_ingenieria", 
"columna_482"=>"req_ctrl_b", 
"columna_483"=>"clli_equipo_cte_b", 
"columna_484"=>"slot_cte_b", 
"columna_485"=>"pto_cte_b", 
"columna_486"=>"clli_equ_ctrl_b", 
"columna_487"=>"slot_ctrl_b", 
"columna_488"=>"pto_ctrl_b", 
"columna_489"=>"aplica_proy_const_b", 
"columna_490"=>"pto_tx_b", 
"columna_491"=>"clli_cole_b", 
"columna_492"=>"slot_cole_b", 
"columna_493"=>"pto_cole_b", 
"columna_494"=>"cap_pto_cole_b", 
"columna_495"=>"estatus_ingenieria_b", 
"columna_496"=>"fecha_sol_ingenieria_b", 
"columna_497"=>"fecha_atn_ingenieria_b", 
"columna_498"=>"observaciones_ingenieria_b", 
"columna_499"=>"tecnologia", 
"columna_500"=>"gdn", 
"columna_501"=>"did", 
"columna_502"=>"maquina", 
"columna_503"=>"remates", 
"columna_504"=>"estatus_asigna_lp_b", 
"columna_505"=>"fecha_sol_asigna_lp_b", 
"columna_506"=>"fecha_atn_asigna_lp_b", 
"columna_507"=>"observaciones_asigna_lp_b", 
"columna_508"=>"supervisor_analisis", 
"columna_509"=>"supervisor_eq_acc", 
"columna_510"=>"supervisor_eq_acc_b", 
"columna_511"=>"supervisor_fibra_optica", 
"columna_512"=>"supervisor_cobre_acc", 
"columna_513"=>"supervisor_cobre_acc_b", 
"columna_514"=>"supervisor_fibra_optica_b", 
"columna_515"=>"modelo_ctrl_a", 
"columna_516"=>"proveedor_ctrl_a", 
"columna_517"=>"modelo_ctl_a", 
"columna_518"=>"proveedor_ctl_a", 
"columna_519"=>"modelo_ctrl_b", 
"columna_520"=>"proveedor_ctrl_b", 
"columna_521"=>"modelo_ctl_b", 
"columna_522"=>"proveedor_ctl_b", 
"columna_523"=>"req_ctl_b", 
"columna_524"=>"req_ctl_a", 
"columna_525"=>"domicilio", 
"columna_526"=>"domicilio_b", 
"columna_527"=>"reqCol_a", 
"columna_528"=>"col_tx_a", 
"columna_529"=>"reqCol_b", 
"columna_530"=>"col_tx_b", 
"columna_531"=>"clli_equ_ctrlR_a", 
"columna_532"=>"clli_equ_ctrlR_b", 
"columna_533"=>"ip_ingenieria", 
"columna_534"=>"supervisor_ingenieria", 
"columna_535"=>"ref_sisa_asociada_b", 
"columna_536"=>"observaciones_aproy", 
"columna_537"=>"observaciones_servicio_gral", 
"columna_538"=>"aplica_colectora_acc", 
"columna_539"=>"aplica_colectora_acc_b", 
"columna_540"=>"ref_sisa_con_interfaz", 
"columna_541"=>"fol_ser_con_interfaz", 
"columna_542"=>"tipo_colectora_acc", 
"columna_543"=>"tipo_colectora_acc_b", 
"columna_544"=>"clli_colectora", 
"columna_545"=>"clli_colectora_b", 
"columna_546"=>"modelo_colectora", 
"columna_547"=>"modelo_colectora_b", 
"columna_548"=>"requiere_infra_cole_b", 
"columna_549"=>"velocidad_infra_cole", 
"columna_550"=>"velocidad_infra_cole_b", 
"columna_551"=>"tipo_ref_aso_b", 
"columna_552"=>"tipo_ref_aso", 
"columna_553"=>"num_modulo", 
"columna_554"=>"posicion_central", 
"columna_555"=>"remates_tks", 
"columna_556"=>"estatus_config_cx", 
"columna_557"=>"fecha_sol_config_cx", 
"columna_558"=>"fecha_atn_config_cx", 
"columna_559"=>"observaciones_config_cx", 
"columna_560"=>"ip_entrega_serv", 
"columna_561"=>"supervisor_entrega_serv", 
"columna_562"=>"fecha_asigna_ip_equi", 
"columna_563"=>"fecha_asigna_ip_equi_b", 
"columna_564"=>"fecha_asigna_ip_fibra", 
"columna_565"=>"fecha_asigna_ip_fibra_b", 
"columna_566"=>"fecha_asigna_ip_cobre_", 
"columna_567"=>"fecha_asigna_ip_cobre_b", 
"columna_568"=>"fecha_asigna_ip_ingenieria", 
"columna_569"=>"fecha_asigna_ip_analisis", 
"columna_570"=>"responsable_cliente", 
"columna_571"=>"telefono_cliente", 
"columna_572"=>"fecha_asigna_ip_entrega_serv", 
"columna_573"=>"recibe_infra_acc_b", 
"columna_574"=>"cope_a", 
"columna_575"=>"cope_b", 
"columna_576"=>"tipo_enlace_a", 
"columna_577"=>"tipo_enlace_b", 
"columna_578"=>"siglas_a_ant", 
"columna_579"=>"siglas_b_ant" 
   ),
		$ref_sisa="ref_sisa",
		$punta="punta"	
	                             )
		{
		$this->arrays=$array_columna;
		$this->ref_sisa=$ref_sisa;
		$this->punta=$punta;
     	}
 
 
    public function __set($parametro,$valor)
	{
 	      if (property_exists($this, $parametro)) 
		  {
 		$this->$parametro = $valor;
 	      }
 	else{
 		echo "Imposible encotrar parametro";
 		 }
	}
 

    public function __get($parametro)
	{
 	 	if (property_exists($this, $parametro)) 
		{
 		return $this->$parametro;
 		}
	 	else
		{
 		echo "no existe propiedad";
 		}
 	}
 
 
 
}

?>