<div class="table-responsive">
    <table class="table table-bordered" id="myTable" >
        <thead class="">

        <th  class="text-center" >
            S/N
        </th>

        <th >
            title

        </th>




        <th >
            photo
        </th>


        <th  class="text-right" >
            status
        </th>


        </thead>
        <tbody>

        @forelse($brands as $brand)


            <tr>

                <td class="td-name">

                {{$loop->iteration}}
                <td>
                    {{$brand->title}}
                </td>
                <td>
                    <img src="{{$brand->photo}}" style="max-height: 190px; max-width: 120px">
                </td>

                <td class="td-number">

                    <input type="checkbox" name="toogle" id="toogle" class="text-secondary" {{$brand->status == 'active' ? 'checked' : ''}} data-toggle="toggle" data-on="Inactive" data-off="Active"   value="{{$brand->id}}">
                </td>
                 <td>
                     <a class="edit_post btn btn-sm btn-outline-warning"> <i class="fa fa-edit"></i></a>
                     <a class="delete_post btn btn-sm btn-outline-danger"> <i class="fa fa-trash-o"></i></a>
                 </td>
            </tr>
        @empty
            <p class="text-center danger"></p>
        @endforelse
        </tbody>
    </table>
</div>
@section('scripts')
    <script>
        $('input[name=toogle]').change(function (){
            var mode=$(this).prop('checked');
            console.log('ok');
            alert(mode);
        });
    </script>
    @endsection
