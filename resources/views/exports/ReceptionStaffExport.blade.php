<table class="table table-hover mt-3" style="min-width:1000px">
    <thead>
        <tr>
            <th>#</th>
            <th scope="col">{{ __('employee')}}</th>
            <th scope="col">{{ __('Patient registration')}}</th>
            <th scope="col">{{ __('Visitor reservations')}}</th>
            <th scope="col">{{ __('Number of invoices paid')}}</th>
            <th scope="col">{{ __('Number of outstanding invoices')}}</th>
            <th scope="col">فواتير تمارا</th>
            <th scope="col">فواتير تابي</th>
            <th scope="col">{{ __('cash')}}</th>
            <th scope="col">{{ __('card')}}</th>
            <th scope="col">فيزا</th>
            <th scope="col">ماستركارد</th>
            <th scope="col">إجمالي تمارا</th>
            <th scope="col">إجمالي تابي</th>
            <th scope="col">{{ __("Add appointments")}}</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($all_users as $user)
        <tr>
            <td>{{ $loop->index+1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->patients_count }}</td>
            <td>{{ $user->num_of_visitors }}</td>
            <td><a
                    href="{{ route('front.invoices.index',['employee_id'=>$user->id,'status'=>'Paid','from'=>$from,'to'=>$to]) }}">{{
                    $user->employee_invoices->where('status','Paid')->count() }}</a></td>
            <td><a
                    href="{{ route('front.invoices.index',['employee_id'=>$user->id,'status'=>'Unpaid','from'=>$from,'to'=>$to]) }}">{{
                    $user->employee_invoices->where('status','Unpaid')->count() }}</a></td>
            <td><a
                    href="{{ route('front.invoices.index',['employee_id'=>$user->id,'status'=>'paid','tmara'=>true,'from'=>$from,'to'=>$to]) }}">{{
                    $user->employee_invoices->where('installment_company',1)->count() }}</a></td>
            <td><a
                    href="{{ route('front.invoices.index',['employee_id'=>$user->id,'status'=>'tab','from'=>$from,'to'=>$to]) }}">{{
                    $user->employee_invoices->where('tab',1)->count() }}</a></td>
            <td>{{ $user->employee_invoices->where('installment_company',0)->sum('cash') }}</td>
            <td>{{ $user->employee_invoices->where('installment_company',0)->sum('card') }}</td>
            <td>{{ $user->employee_invoices->where('installment_company',0)->sum('bank') }}</td>
            <td>{{ $user->employee_invoices->where('installment_company',0)->sum('visa') }}</td>
            <td>{{ $user->employee_invoices->where('installment_company',0)->sum('mastercard') }}</td>
            <td>{{ $user->employee_invoices->where('installment_company',1)->sum('total') }}</td>
            <td>{{ $user->employee_invoices->where('tab',1)->sum('total') }}</td>
            <td>{{ $user->employee_appointments_count }}</td>
        </tr>
        @endforeach


    </tbody>
</table>
