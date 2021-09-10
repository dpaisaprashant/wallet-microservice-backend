<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        Admin::query()->truncate();
        Permission::query()->truncate();
        Role::query()->truncate();*/


        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'Dashboard',
            'Dashboard all transactions sum',
            'Dashboard successful transactions count',
            'Dashboard total KYC not filled users',
            'Dashboard total KYC filled users',
            'Dashboard users transactions graph',
            'Dashboard highest transactions table',

            'Dashboard total KYC accepted by backend user count',
            'Dashboard total KYC rejected by backend user count',

            'Dashboard total NPay clearance cleared by backend user count',
            'Dashboard total Paypoint clearance cleared by backend user count',

            'Dashboard npay clearance table',
            'Dashboard paypoint clearance table',

            'Dashboard accepted KYC table',
            'Dashboard rejected KYC table',

            //dashboard
            'Dashboard NCHL bank transfer',
            'Dashboard NCHL load transaction',

            'Stat Dashboard KYC',
            'Stat Dashboard paypoint',
            'Stat Dashboard npay',

            'Development tools view',
            'Development tool backup database',

            'Backend user update profile',
            'Backend user change password',

            'Backend users view',
            'Backend user update permission',
            'Backend user update role',
            'Backend user reset password',
            'Backend user create',

            'Roles view',
            'Role create',
            'Role edit',

            'Bank list view',
            'Bank list profile',

            'Backend user log view',

            'Users view',
            'User profile',
            'User transactions',
            'User deactivate',
            'User activate',

            'Deactivate users view',

            'Locked users view',
            'Locked user login attempts view',
            'Locked user login attempt enable',

            'KYC not filled users view',
            'Unverified KYC users view',
            'KYC list changed by backend user view',
            'User KYC view',
            'KYC accept',
            'KYC reject',
            'Edit user kyc',
            'View admin edited kyc',
            'Create user kyc',

            'Complete transaction view',

            'Fund transfer view',
            'Fund transfer detail',

            'Fund request view',
            'Fund request detail',

            'EBanking view',
            'EBanking detail',

            'Paypoint view',
            'Paypoint request view',
            'Paypoint response view',
            'Paypoint detail',

            'Failed paypoint view',
            'Failed paypoint request view',
            'Failed paypoint response view',
            'Failed paypoint detail',

            'Failed npay view',
            'Failed npay response view',
            'Failed npay detail',

            'Clearance npay',
            'Clearance paypoint',
            'Clearance npay clear transaction',
            'Clearance paypoint clear transaction',

            'Clearance npay view',
            'Clearance paypoint view',

            'Clearance npay change status',
            'Clearance paypoint change status',

            'Clearance npay transactions view',
            'Clearance paypoint transactions view',

            'Clearance npay handle dispute',
            'Clearance paypoint handle dispute',

            'Dispute create',
            'Dispute view',
            'Dispute detail view',
            'Dispute handle single',

            'Dispute accept',
            'Dispute reject',

            'View all audit trial',
            'View npay audit trial',
            'View paypoint audit trial',
            'View nchl bank transfer audit trail',
            'View nchl load transaction audit trail',

            'Monthly report view',
            'Yearly report view',

            'User session log view',
            'Auditing log view',
            'Profiling log view',
            'Statistics log view',
            'Development log view',

            'Notification view',
            'Notification create',
            'Send notification to user',

            'Sparrow SMS view',
            'Sparrow SMS detail view',

            'Miracle info SMS view',

            'General page setting view',
            'General page setting create',
            'General page setting update',
            'General page setting delete',

            //settings
            'General setting view',
            'General setting update',

            'Npay setting view',
            'Npay setting update',

            'Paypoint setting view',
            'Paypoint setting update',
            'Paypoint commission setting view',
            'Paypoint cashback setting view',

            'Limits setting view',
            'Limits setting update',
            'Clear daily limit',
            'Clear monthly limit',

            'Transaction fee setting view',
            'KYC setting view',
            'OTP setting view',
            //end settings

            //Frontend settings
            'Frontend header view',
            'Frontend header create',
            'Frontend header update',
            'Frontend header delete',

            'Frontend service view',
            'Frontend service create',
            'Frontend service update',
            'Frontend service delete',

            'Frontend about view',
            'Frontend about create',
            'Frontend about update',
            'Frontend about delete',

            'Frontend process view',
            'Frontend process create',
            'Frontend process update',
            'Frontend process delete',

            'Frontend banner view',
            'Frontend banner create',
            'Frontend banner update',
            'Frontend banner delete',

            'Frontend contact view',
            'Frontend contact create',

            'Frontend faq view',
            'Frontend faq create',
            'Frontend faq update',
            'Frontend faq delete',

            'Frontend news view',
            'Frontend news create',
            'Frontend news update',
            'Frontend news delete',

            'Frontend solution view',
            'Frontend solution create',
            'Frontend solution update',
            'Frontend solution delete',

            'Frontend partner view',
            'Frontend partner create',
            'Frontend partner update',
            'Frontend partner delete',
            //End frontend settings

            'Terms and condition view',
            'Terms and condition update',

            'Group force password change',

            'Merchant dashboard',
            'Merchant locked view',
            'Merchant profile',

            'Architecture vendor transaction',

            //agents
            'Agent view',
            'Agent create',
            'Agent type view',
            'Agent type create',

            //refund
            'Refund view',
            'Refund create',

            //repost transaction
            'Repost transaction npay',
            'Repost transaction nps',
            'Repost transaction connectips',

            'Transaction nps view',
            'Transaction nchl load',
            'Transaction nchl bank transfer',
            'Nicasia cybersource load transaction',


            //Report
            'Report paypoint',
            'Report npay',
            'Report nchl load',
            'Report referral',
            'Report register using referral user',
            'Report subscriber daily',
            'Report reconciliation',
            'Report nrb active and inactive user',
            'Report non bank payment',
            'Report wallet end balance',
            'Report admin kyc',
            'Report commission',
            'Report nrb agent',

            //setting
            'Nps setting view',
            'Nchl load setting view',
            'Nchl bank transfer setting view',
            'Nchl aggregated setting view',
            'Nicasia cybersource setting view',
            'Referral setting view',
            'Bonus setting view',
            'Notification setting view',
            'Redirect setting view',
            'Merchant setting view',

            'Api log',

            'Merchant event list',
            'Merchant pending event list',

            'Add cashback to user type',
            'Add cashback to agent type',
            'Add cashback to merchant type',

            'Add commission to user type',
            'Add commission to agent type',
            'Add commission to merchant type',

            'Add cashback to single user',
            'Add commission to single user',

            'Add wallet transaction type',
            'View wallet transaction type',
            'Edit wallet transaction type',

            'View agent profile',

            'View wallet permission transaction type',
            'Add wallet permission transaction type',
            'Delete wallet permission transaction type',

            'View BFI Merchant',
            'Add BFI Merchant',
            'Delete BFI Merchant',

            'View BFI user',
            'View secret key',
            'Add ip',
            'Edit BFI user status',
            'Add BFI user',


            'Add blocked ip',
            'Delete blocked ip',
            'Edit blocked ip',
            'View blocked ip',

            'View request info',


            'View and update agent type hierarchy cashback',

            'View bfi execute payment',
            'View bfi to user fund transfer',
            'View user to bfi fund transfer',

            'Add wallet service',
            'View wallet service',
            'Edit wallet service',
            'Delete wallet service',

            'View pre-transactions',


            'View khalti details',
            'View khalti detail page',


            'Add whitelisted ip',
            'Delete whitelisted ip',
            'Edit whitelisted ip',
            'View whitelisted ip',


            'View and update agent type hierarchy cashback',

            'View bfi execute payment',
            'View bfi to user fund transfer',
            'View user to bfi fund transfer',

            // NicAsia
            'Nicasia cybersource view',
            'Nicasia cybersource detail',

            //Cellpay
            'Cellpay user transaction view',
            'Cellpay user transaction detail',

            //Account_Link
            'View load wallet',
            'Generate load wallet excel',
            'View nps linked account',

            //Mismtached user balance and bonus balance
            'View mismatched user balance and bonus balance',

            //Run seeder
            'View seeder list',
            'Run seeder',

            'View nchl aggregated payment',

            //Non Real Time Bank Payment
            'Create non real time bank payment',
            'View non real time bank payment',


            //Scheme
            'View scheme',
            'Create scheme',
            'Edit scheme',
            'Delete scheme',

            //Merchant Products
            'View merchant product',
            'Add merchant product',
            'Edit merchant product',
            'Delete merchant product',



            ];

        //get users having all permissions
        $admin = Admin::first();
        if (! count(Admin::all())) {
            $admin = Admin::create([
                'name' => 'Avaya Baniya',
                'email' => 'baniyaavaya@gmail.com',
                'password' => bcrypt('password'),
                'mobile_no' => '9860089363'
            ]);
        }

        $role = Role::where('name', 'Super admin')->first();
        if (! $role) {
            $role = Role::create(['name' => 'Super admin']);
            $admin->assignRole('Super admin');
        }


        //create permission
        foreach ($permissions as $key  => $permission) {

            if ( ! Permission::where('name', $permission)->first()) {
                $permission = Permission::create(['name' => $permission]);
            }

           if(! $role->hasPermissionTo($permission) ) {

               $role->givePermissionTo($permission);
           }

        }

        /*$superAdmins = Admin::all();
        $superAdmins->map(function($value) use($permissions) {
           if($value->hasRole("Super admin") || $value->hasRole("Admin")){
            $value->givePermissionTo($permissions);
           }
        });*/
    }
}
