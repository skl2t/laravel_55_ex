@foreach($comments as $comment)
	<div class="box">
		<div class="box-body table-responsive">
			<table id="comments" class="table table-striped table-bordered">
				<thead>
				<tr>
					<th width="15%">@lang('Name')</th>
					<th width="15%">@lang('Email')</th>
					<th width="35%">@lang('Post')</th>
					<th width="10%">@lang('New')</th>
					<th width="10%">@lang('Valid')</th>
					<th width="10%">@lang('Creation')</th>
					<th width="5%"></th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>{{ $comment->user->name }}</td>
					<td>{{ $comment->user->email }}</td>
					<td>
						<a href="{{ route('posts.display', [$comment->post->slug ]) }}">{{ $comment->post->title }}</a>
						<br><span class="badge">{{ $comment->post->comments_count }}</span>
					</td>
					<td>
						<input type="checkbox" name="seen"
						       value="{{ $comment->id }}" {{ is_null($comment->ingoing) ?  'disabled' : 'checked'}}>
					</td>
					<td>
						<input type="checkbox" name="uservalid"
						       value="{{ $comment->user->id }}" {{ $comment->user->valid ?  'checked disabled' : ''}}>
					</td>
					<td>{{ $comment->created_at->formatLocalized('%c') }}</td>
					<td><a class="btn btn-danger btn-xs btn-block"
					       href="{{ route('comments.destroy', [$comment->id]) }}" role="button"
					       title="@lang('Destroy')"><span class="fa fa-remove"></span></a></td>
				</tr>
				</tbody>
			</table>
		</div>
		<!-- /.box-body -->
		<div id="message" class="box-footer">
			{{ $comment->body }}
		</div>
	</div>
	<!-- /.box -->
@endforeach
