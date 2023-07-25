<h1>Listagem de Suportes Ativos</h1>

<a href="{{ route('supports.create') }}">Nova Duvida</a>

<table>
	<thead>
		<th>Assunto			</th>
		<th>Status			</th>
		<th>Descrição		</th>
		<th>Exibir mais </th>
	</thead>
	<tbody>
		@foreach($supports->items() as $support)
			<tr>
				<td>{{ $support->subject }}	</td>
				<td>{{ $support->status  }}	</td>
				<td>{{ $support->body		 }}	</td>
				<td>
						<a href="{{ route('supports.show', $support->id) }}">Exibir
						</a>	
						<a href="{{ route('supports.edit', $support->id) }}">Editar
						</a>	
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

<x-pagination 
	:paginator="$supports"
	:appends="$filters" 
	/>