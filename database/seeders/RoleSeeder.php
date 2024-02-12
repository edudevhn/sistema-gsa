<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1= Role::create(['name'=>'Admin']);
        $role2= Role::create(['name'=>'Contador']);

        Permission::create(['name'=>'admin.home',
                            'description'=>'Ver el dashboard'])->syncRoles([$role1,$role2]);
                            
        Permission::create(['name'=>'admin.parameters.index',
                            'description'=>'Ver listado de parametros'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.parameters.create',
                            'description'=>'Crear parametros'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.parameters.edit',
                            'description'=>'Editar parametros'])->syncRoles([$role1]);


        Permission::create(['name'=>'admin.users.index',
                            'description'=>'Ver listado de usuarios'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.users.edit',
                            'description'=>'Asignar un rol'])->syncRoles([$role1]);
        // Permission::create(['name'=>'admin.users.update',
        //                     'description'=>'Confirmar guardar rol'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.roles.index',
                            'description'=>'Ver listado de roles'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.roles.create',
                            'description'=>'Crear rol'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.roles.edit',
                            'description'=>'Editar rol'])->syncRoles([$role1]);
        
        Permission::create(['name'=>'admin.aduanas.index',
                            'description'=>'Ver listado de aduanas'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.aduanas.create',
                            'description'=>'Crear aduanas'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.aduanas.edit',
                            'description'=>'Editar aduanas'])->syncRoles([$role1]);
        
        Permission::create(['name'=>'admin.tipoPersonas.index',
                            'description'=>'Ver listado de tipo de persona'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.tipoPersonas.create',
                            'description'=>'Crear tipo de persona'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.tipoPersonas.edit',
                            'description'=>'Editar tipo de persona'])->syncRoles([$role1]);
                            
        Permission::create(['name'=>'admin.tipoDocumentosFiscales.index',
                            'description'=>'Ver listado de tipo de documentos fiscales'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.tipoDocumentosFiscales.create',
                            'description'=>'Crear tipo de documentos fiscales'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.tipoDocumentosFiscales.edit',
                            'description'=>'Editar tipo de documentos fiscales'])->syncRoles([$role1]);

                            
        Permission::create(['name'=>'admin.rangoDocumentosFiscales.index',
                            'description'=>'Ver listado de rangos de documentos fiscales'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.rangoDocumentosFiscales.create',
                            'description'=>'Crear rangos de documentos fiscales'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.rangoDocumentosFiscales.edit',
                            'description'=>'Editar rangos de documentos fiscales'])->syncRoles([$role1]);
                            
                            
        Permission::create(['name'=>'admin.valueTypes.index',
                            'description'=>'Ver listado de tipo de valores'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.valueTypes.create',
                            'description'=>'Crear tipo de valores'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.valueTypes.edit',
                            'description'=>'Editar tipo de valores'])->syncRoles([$role1]);
                            
        Permission::create(['name'=>'admin.cuentas.index',
                            'description'=>'Ver listado de Cuentas'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.cuentas.create',
                            'description'=>'Crear Cuentas'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.cuentas.edit',
                            'description'=>'Editar Cuentas'])->syncRoles([$role1]);


        Permission::create(['name'=>'admin.personas.index',
                            'description'=>'Ver listado de Personas'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.personas.create',
                            'description'=>'Crear Persona'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.personas.edit',
                            'description'=>'Editar Persona'])->syncRoles([$role1]);


        Permission::create(['name'=>'admin.cuentasBancarias.index',
                            'description'=>'Ver listado de Cuentas Bancarias'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.cuentasBancarias.create',
                            'description'=>'Crear Cuenta Bancaria'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.cuentasBancarias.edit',
                            'description'=>'Editar Cuenta Bancaria'])->syncRoles([$role1]);


        Permission::create(['name'=>'admin.monedas.index',
                            'description'=>'Ver listado de monedas'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.monedas.create',
                            'description'=>'Crear moneda'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.monedas.edit',
                            'description'=>'Editar moneda'])->syncRoles([$role1]);


        Permission::create(['name'=>'admin.servicios.index',
                            'description'=>'Ver listado de servicios'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.servicios.create',
                            'description'=>'Crear Servicio'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.servicios.edit',
                            'description'=>'Editar Servicio'])->syncRoles([$role1]);




        Permission::create(['name'=>'admin.cotizaciones.index',
                            'description'=>'Ver listado de cotizaciones'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.cotizaciones.create',
                            'description'=>'Crear Cotizacion'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.cotizaciones.edit',
                            'description'=>'Editar Cotizacion'])->syncRoles([$role1]);


        Permission::create(['name'=>'admin.embarques.index',
                            'description'=>'Ver listado de Embarques'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.embarques.create',
                            'description'=>'Crear Embarque'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.embarques.edit',
                            'description'=>'Editar Embarque'])->syncRoles([$role1]);
                            
                            
        Permission::create(['name'=>'admin.proformas.index',
        'description'=>'Ver listado de proformas'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.proformas.create',
                'description'=>'Crear Embarque'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.proformas.edit',
                'description'=>'Editar Embarque'])->syncRoles([$role1]);
                
        Permission::create(['name'=>'admin.documentosFiscales.index',
                            'description'=>'Ver listado de Documentos Fiscales'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.documentosFiscales.create',
                            'description'=>'Crear Documento Fiscal'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.documentosFiscales.edit',
                            'description'=>'Editar Documento Fiscal'])->syncRoles([$role1]);
                            
                            
        
        Permission::create(['name'=>'admin.pagos.index',
                            'description'=>'Ver listado de pagos'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.pagos.create',
                            'description'=>'Crear Pago'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.pagos.edit',
                            'description'=>'Editar Pago'])->syncRoles([$role1]);
                            
                            
        Permission::create(['name'=>'admin.costos.index',
                            'description'=>'Ver listado de costos/gastos'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.costos.create',
                            'description'=>'Crear Costo/ Gasto'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.costos.edit',
                            'description'=>'Editar Costo/Gasto'])->syncRoles([$role1]);
                            
        Permission::create(['name'=>'admin.cxc.index',
                            'description'=>'Reporte de Estado de Cuentas por Cobrar'])->syncRoles([$role1,$role2]);
        
        Permission::create(['name'=>'admin.cxp.index',
                            'description'=>'Reporte de Estado de Cuentas por Pagar'])->syncRoles([$role1,$role2]);
        
                                    
        
        Permission::create(['name'=>'admin.categories.index',
                            'description'=>'Ver listado de categorias'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.categories.create',
                            'description'=>'Crear categorias'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.categories.edit',
                            'description'=>'Editar categorias'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.categories.destroy',
                            'description'=>'Eliminar categorias'])->syncRoles([$role1]);

        
        Permission::create(['name'=>'admin.tags.index',
                            'description'=>'Ver listado de etiquetas'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.tags.create',
                            'description'=>'Crear etiquetas'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.tags.edit',
                            'description'=>'Modificar etiquetas'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.tags.destroy',
                            'description'=>'Eliminar etiquetas'])->syncRoles([$role1]);

        
        Permission::create(['name'=>'admin.posts.index',
                            'description'=>'Ver listado de posts'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.posts.create',
                            'description'=>'Crear posts'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.posts.edit',
                            'description'=>'Modificar posts'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.posts.destroy',
                            'description'=>'Eliminar posts'])->syncRoles([$role1,$role2]);

    }
}
