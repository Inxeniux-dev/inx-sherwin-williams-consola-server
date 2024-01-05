<?php

class PermisoService
{
    function generatePermissionSchema()
    {
          $schema = [
                "Versionamiento" => [
                    "Listado_de_Versiones" =>[
                        "Consultar" => false,
                        "Crear" => false,
                        "Editar" => false,
                        "Eliminar" => false,
                      ],
                    "Version_en_Tiendas" => [
                        "Consultar" => false,
                    ]
                ],
                "Catalogos" => [
                    "Sucursales" => [
                        "Consultar" => false,
                        "Crear" => false,
                        "Editar" => false,
                        "Eliminar" => false,
                        "Query_Remota" => false
                    ],
                    "Tarjeta_Puntos" => [
                        "Consultar" => false,
                        "Crear" => false,
                        "Editar" => false,
                        "Eliminar" => false
                    ],
                    "Articulos" => [
                        "Consultar" => false,
                        "Crear" => false,
                        "Editar" => false,
                        "Eliminar" => false,
                        "Editar_Precio" => false,
                        "Editar_Descuento" => false
                    ],
                    "Productos_para_Canje" => [
                        "Consultar" => false,
                        "Crear" => false,
                        "Editar" => false,
                        "Eliminar" => false
                    ],
                    "Catalogos_generales" => [
                        "Consultar" => false,
                        "Crear" => false,
                        "Editar" => false,
                        "Eliminar" => false
                    ]
                ],
                "Libreta_de_Pagos" => [
                    "Listado_de_Facturas" =>[
                        "Consultar" => false,
                        "Crear" => false,
                        "Editar" => false
                      ]
                ],
                "Asistencia" => [
                    "Empleados" => [
                        "Consultar" => false,
                        "Crear" => false,
                        "Editar" => false,
                        "Eliminar" => false,
                        "Configuracion_avanzada" => false
                    ],
                    "Rotacion_de_Personal" => [
                        "Consultar" => false,
                        "Crear" => false,
                        "Editar" => false
                    ],
                    "Listado_de_Asistencia" => [
                          "Consultar" => false
                    ],
                    "Listado_de_Asistencia_Supervisor" => [
                          "Consultar" => false
                    ],
                    "Listado_de_Retardos" => [
                          "Consultar" => false,
                          "Editar" => false
                    ]
                ],
                "Herramientas" => [
                    "Archivo_de_Precios" => [
                        "Editar" => false
                    ],
                    "Respaldo_de_Sucursales" => [
                        "Consultar" => false
                    ],
                    "Estructura_de_DB_Tiendas" => [
                        "Consultar" => false
                    ],
                    "Pedidos_y_Vales" => [
                        "Consultar" => false,
                        "Editar" => false,
                        "Eliminar" => false
                    ],
                    "Dias_Inhabiles" => [
                        "Crear" => false
                    ],
                ],
                "Gestion" => [
                    "Transferencias_bancarias" => [
                        "Consultar" => false,
                        "Editar" => false
                    ],
                    "Listado_de_cambio_de_precios" => [
                        "Consultar" => false
                    ]
                ],
                "Configuracion" => [
                    "Sistema" => [
                        "Crear" => false,
                    ],
                    "Usuarios" => [
                        "Consultar" => false,
                        "Crear" => false,
                        "Editar" => false,
                        "Eliminar" => false
                    ]
                ]
          ];

          return $schema;
    }



    function generatePermissionSchemaPOS()
    {
      $schema = [
            "Corte" => [
                "Cierre_Diario" =>[
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                  ],
                "Cierre_Mensual" =>[
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                  ],
            ],
            "Punto_de_Venta" => [
                "Ventas" =>[
                    "Crear" => false,
                    "Consultar" => false,
                ],
                "Avanzado" =>[
                    "Cancelar_Venta" => false,
                    "Devolver_Venta" => false,
                    "Editar" => false,
                    "Cambiar_Factura_a_Mostrador"=> false,
                    "Cambiar_Uso_CFDI" => false,
                    "Editar_Objetivo" => false,
                ],
                "Deposito" =>[
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                ],
                "Reportes" =>[
                    "Listado_de_Igualados" => false,
                    "Salida_por_Ventas" => false,
                    "Ventas_por_Cliente" => false,
                    "Ventas_por_Cliente_Acumulado" => false,
                    "Ventas_por_Producto" => false,
                    "Ventas_con_Puntos" => false,
                    "Ventas_por_Agente" => false,
                ],
                "Transferencias_Bancarias" => [
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false
                ]
            ],
            "Vales_de_Traspaso" => [
                "Vales" =>[
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                ],
                "Entradas" =>[
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                ],
                "Tipos_de_Vales" =>[
                    "Entrada_por_traspaso" => false,
                    "Salida_por_traspaso" => false,
                    "Entrada_por_ajuste" => false,
                    "Salida_por_ajuste" => false,
                    "Entrada_monetaria" => false,
                    "Salida_monetaria" => false,
                ],
                "Pedidos_de_Mercancia" =>[
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                ],
                "Avanzado" =>[
                    "Cruze_de_vales" => false,
                    "Cruze_de_vales_global" => false,
                ],
            ],
            "Catalogos" => [
                "Articulos" =>[
                    "Consultar" => false,
                    "Editar" => false,
                    "Consultar_existencia_remota" => false
                ],
                "Clientes" =>[
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                    "Editar_Precio_Especial" => false,
                    "Editar_Descuento" => false,
                    "Exportar" => false
                ],
                "Sucursales" =>[
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false,
                    "Eliminar" => false
                ],
                "Cuentas_Bancarias" =>[
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false,
                    "Eliminar" => false
                ],
                "Tarjeta_de_Puntos" =>[
                    "Crear" => false,
                    "Consultar" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                    "Canjear_Puntos" => false
                ],
                "Lineas" =>[
                    "Consultar" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                    "Eliminar" => false
                ],
                "Lineas" =>[
                    "Consultar" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                    "Eliminar" => false
                ],
                "Agentes" =>[
                    "Consultar" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                    "Eliminar" => false
                ],
                "Clientes_mostrador" =>[
                    "Consultar" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                    "Eliminar" => false
                ],
            ],
            "Inventarios_de_Mercancia" => [
                "Inventario" =>[
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                    "Valorizado" => false
                ],
                "Conversiones" =>[
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                ],
                "Productos_No_Aplicados" =>[
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                ],
                "Cambio_de_Precios" =>[
                    "Consultar" => false,
                    "Crear" => false,
                ],
            ],
            "Creditos" => [
                "Listar_clientes_con_credito" =>[
                    "Consultar" => false,
                ],
                "Estado_de_cuenta" =>[
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                ],
                "Complemento_de_pago" =>[
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                ],
                "Antiguedad_de_saldo" =>[
                    "Consultar" => false,
                ],
                "Cargos_Abonos" =>[
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                ],
                "Autorizar_credito" =>[
                    "Crear" => false,
                    "Editar" => false
                ],
                "Ajuste_de_saldos" =>[
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                ],
                "Estado_de_cuenta" =>[
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                ],
            ],
            "Reporteria_General" => [
                "Entradas_y_salidas" =>[
                    "Consultar" => false,
                ],
                "Valorizado_de_sucursales" =>[
                    "Consultar" => false,
                ],
                "Corte_de_tiendas" =>[
                    "Consultar" => false,
                ],
                "Producto_generico" =>[
                    "Consultar" => false,
                ],
                "Operaciones_diarias" =>[
                    "Consultar" => false,
                ],
                "Operaciones_diarias_global" =>[
                    "Consultar" => false,
                ],
                "Concentrado_de_sucursales" =>[
                    "Consultar" => false,
                ],
                "Ventas_por_agente" =>[
                    "Consultar" => false,
                ],
                "Listado_de_cancelaciones" =>[
                    "Consultar" => false,
                ],
                "Detallado_de_ventas" =>[
                    "Consultar" => false,
                ],
                "Detallado_de_devoluciones" =>[
                    "Consultar" => false,
                ],
                 "Contado_mas_cobranza" =>[
                    "Consultar" => false,
                ],
                 "Listado_de_devoluciones" =>[
                    "Consultar" => false,
                 ],
                 "Productos_ventas" =>[
                    "Consultar" => false,
                 ],
                 "Club_del_pintor" =>[
                    "Consultar" => false,
                ]
            ],
            "Ajustes" => [
                "Capas" =>[
                    "Consultar" => false,
                    "Editar" => false,
                ],
                "Restaurar_respaldo" =>[
                    "Consultar" => false,
                    "Crear" => false,
                ],
                "Configuracion" =>[
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                ],
                "Usuarios" =>[
                    "Consultar" => false,
                    "Crear" => false,
                    "Editar" => false,
                    "Eliminar" => false,
                ],
                "Generar_clave_desbloqueo" =>[
                    "Crear" => false,
                ],
                "Cambiar_de_sucursal_pdv" =>[
                    "Editar" => false,
                ],
                "Cierres_almacenados" =>[
                    "Consultar" => false,
                    "Editar" => false,
                ],
                "Huellas_Canje_Acumulado" =>[
                   "Consultar" => false,
                   "Editar" => false,
               ],
               "Carga_Archivo_Venta" =>[
                  "Crear" => false,
                  "Editar" => false,
              ]
            ],
             "CRM" => [
                    "Login" =>[
                        "Consultar" => false,
                      ]
                ],
          ];


          return $schema;
    }




     function generatePermissionSchemaCRM()
    {
          $schema = [
                "Reportes" => [
                    "Bitacora" =>[
                        "Consultar" => false,
                        "Crear" => false,
                        "Editar" => false,
                        "Eliminar" => false,
                      ],
                ],
                "Configuracion" => [
                    "Usuarios" => [
                        "Consultar" => false,
                        "Crear" => false,
                        "Editar" => false,
                        "Eliminar" => false,
                    ],
                ]
          ];

          return $schema;
    }

}





?>
