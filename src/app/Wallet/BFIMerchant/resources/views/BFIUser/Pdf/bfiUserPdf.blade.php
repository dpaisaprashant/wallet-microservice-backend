<style>
    table,th,td{
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<p style="font-size: 20px;">BFI User details</p>
<br>
<table max-width="90%;" >
    <tr>
        <th width="120px">Key</th>
        <th>Value</th>
    </tr>
    <tr>
        <td width="120px">BFI Id</td>
        <td>{{ $bfiUsers->bfi_id }}</td>
    </tr>
    <tr>
        <td width="120px">BFI Name</td>
        <td>{{ $bfiUsers->bfi_name }}</td>
    </tr>
    <tr>
        <td width="120px">API Username</td>
        <td>{{ $bfiUsers->api_username }}</td>
    </tr>
    <tr>
        <td width="120px">Portal Username</td>
        <td>{{ $bfiUsers->portal_username }}</td>
    </tr>
    <tr>
        <td width="120px">Email</td>
        <td>{{ $bfiUsers->email }}</td>
    </tr>
    <tr>
        <td width="120px">Api Password</td>
        <td>{{$api_password}}</td>
    </tr>
    <tr>
        <td width="120px">Portal Password</td>
        <td>{{$portal_password}}</td>
    </tr>
    <tr>
        <td width="120px">Secret Key</td>
        <td style="font-size: 12px">{{ $bfiUsers->UserApiDetail->secret_key }}</td>
    </tr>
    <tr>
        <td width="120px">Status</td>
        <td>{{ $bfiUsers->status == 1 ? 'Active' : 'Inactive' }}</td>
    </tr>

</table>
