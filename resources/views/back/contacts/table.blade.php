@foreach($contacts as $contact)
	<div class="box">
		<div class="box-body table-responsive">
			<table id="contacts" class="table table-striped table-bordered">
				<thead>
				<tr>
					<th width="30%">@lang('Name')</th>
					<th width="30%">@lang('Email')</th>
					<th width="10%">@lang('New')</th>
					<th width="25%">@lang('Creation')</th>
					<th width="5%"></th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>{{ $contact->name }}</td>
					<td>{{ $contact->email }}</td>
					<td>
						<input type="checkbox" name="seen"
						       value="{{ $contact->id }}" {{ is_null($contact->ingoing) ?  'disabled' : 'checked'}}>
					</td>
					<td>{{ $contact->created_at->formatLocalized('%c') }}</td>
					<td><a class="btn btn-danger btn-xs btn-block"
					       href="{{ route('contacts.destroy', [$contact->id]) }}" role="button"
					       title="@lang('Destroy')"><span class="fa fa-remove"></span></a></td>
				</tr>
				</tbody>
			</table>
		</div>
		<!-- /.box-body -->
		<div id="message" class="box-footer">
			{{ $contact->message }}
		</div>
	</div>
	<!-- /.box -->
@endforeach
