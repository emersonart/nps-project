<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	protected $table;
	protected $alias;
	protected $primaryKey;
	protected $fillable = array(); // Campos que podem ser alterados
	protected $updated_field = 'updated_at'; // Campo de data e hora para atualização
	protected $deleted_field = 'deleted_at'; // Campo de data e hora para exclusão

	// Array com os relacionamentos
	protected $has_many = array(
		// 'outra_tabela' => array(
		//   'model' => 'outra_tabela_model',
		//   'alias' => 'otm',
		//   'primary_key' => 'id_outra_tabela',
		//   'foreign_key' => 'id',
		//   'get_relate' => true, // Carrega os dados relacionados automaticamente em cada consulta,
		//   'relationship' => 'INNER'
		// )
	);

	public function __construct()
	{
		parent::__construct();
		if (!$this->table || !$this->alias || !$this->primaryKey) {
			throw new Exception('Inicie corretamente a classe');
		}
	}

	public function getById($id)
	{
		$query = $this->db->get_where($this->table, array($this->primaryKey => $id));
		$result = $query->row_array();
		foreach ($this->has_many as $table => $options) {
			if ($options['get_relate']) {
				$this->load->model($options['model'], $options['alias']);
				$this->db->where($options['foreign_key'], $id);
				$result[$table] = $this->{$options['alias']}->get_all();
			}
		}
		return $result;
	}

	public function get_all($params = array(), $deleted = false)
	{
		$where = isset($params['where']) ? $params['where'] : [];
		$or_where = isset($params['or_where']) ? $params['or_where'] : [];
		$limit = isset($params['limit']) ? $params['limit'] : null;
		$offset = isset($params['offset']) ? $params['offset'] : null;
		$order_by = isset($params['order_by']) ? $params['order_by'] : null;
		$select = isset($params['select']) ? $params['select'] : '*';
		$get_related = isset($params['get_related']) ? $params['get_related'] : false;

		// Define o SELECT padrão para a tabela principal
		$this->db->select($select ?: $this->alias . '.*');
		if (!$deleted) {
			$this->db->group_start();
			$this->db->or_where($this->alias . "." . $this->deleted_field, '0000-00-00 00:00:00');
			$this->db->or_where($this->alias . "." . $this->deleted_field, '');
			$this->db->or_where($this->alias . "." . $this->deleted_field . " IS NULL", '', FALSE);
			$this->db->group_end();
		}

		// Define o WHERE para a tabela principal
		if ($where) {
			foreach ($where as $key => $value) {

				if (is_array($value)) {

					foreach ($value as $operator => $val) {
						$this->db->where($key . ' ' . $operator, $val);
					}
				} else {

					$this->db->where($key, $value);
				}
			}
		}

		// Define o OP WHERE para a tabela principal
		if ($or_where) {
			$this->db->group_start();
			foreach ($or_where as $key => $value) {

				if (is_array($value)) {

					foreach ($value as $operator => $val) {
						$this->db->or_where($key . ' ' . $operator, $val);
					}
				} else {

					$this->db->where($key, $value);
				}
			}
			$this->db->group_end();
		}

		// Define o ORDER BY para a tabela principal
		if (!empty($order_by)) {
			if (is_array($order_by)) {
				foreach ($order_by as $column => $direction) {
					$this->db->order_by( $column, $direction);
				}
			} else {
				$this->db->order_by($order_by);
			}
		}

		// Define o LIMIT para a tabela principal
		if (!empty($limit)) {
			$this->db->limit($limit, $offset ?: 0);
		}
		if ($get_related) {
			foreach ($this->has_many as $table => $options) {

				$this->db->join($table . " " . $options['alias'], $options['alias'] . "." . $options['primary_key'] . " = " . $this->alias . "." . $options['foreign_key'], $options['relationship']);
			}
		}


		// // Loop através de todos os relacionamentos definidos em $has_many
		// foreach ($this->has_many as $table => $options) {
		//   // Carrega o modelo para o relacionamento
		//   $this->load->model($options['model'],$options['alias']);

		//   // Define o SELECT para a tabela relacionada
		//   $related_select = $options['select'] ?: $options['model'] . '.*';

		//   // Define o JOIN para a tabela relacionada
		//   $this->db->join($options['table'], $this->_table . '.' . $this->primary_key . ' = ' . $options['table'] . '.' . $options['foreign_key']);

		//   // Define o SELECT para a tabela relacionada e o JOIN
		//   $this->db->select($related_select);

		//   // Define o WHERE para a tabela relacionada
		//   if (!empty($options['where'])) {
		//     foreach ($options['where'] as $key => $value) {
		//       if (is_array($value)) {
		//         $this->db->group_start();
		//         foreach ($value as $operator => $val) {
		//           $this->db->where($options['table'] . '.' . $key . ' ' . $operator, $val);
		//         }
		//         $this->db->group_end();
		//       } else {
		//         $this->db->where($options['table'] . '.' . $key, $value);
		//       }
		//     }
		//   }

		//   // Loop através de todos os resultados da tabela principal e recupera os dados relacionados
		//   foreach ($results as &$row) {
		//     $row[$table] = $this->{$options['model']}->get_all(array($options['foreign_key'] => $row[$this->primary_key]), null, null, null, $related_select);
		//   }
		// }

		// Recupera os dados da tabela principal
		$this->db->from($this->table . " " . $this->alias);
		$query = $this->db->get();
		$results = $query ? $query->result_array() : false;

		return $results;
	}

	public function insert($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	public function update($id, $data)
	{
		$this->db->where($this->primaryKey, $id);
		$this->db->where($this->deleted_field, NULL); // Não permite atualização se o registro foi excluído.
		$update_data = array_intersect_key($data, array_flip($this->fillable)); // Seleciona apenas os campos permitidos para atualização.
		$data[$this->updated_field] = date('Y-m-d H:i:s'); // Insere o horário da atualização.
		$this->db->update($this->table, $update_data);
		return $this->db->affected_rows();
	}

	public function delete($id, $permanent = false)
	{
		if ($permanent) {
			$this->db->where($this->primaryKey, $id);
			$this->db->delete($this->table);
		} else {
			$this->db->where($this->primaryKey, $id);
			$this->db->where($this->deleted_field, NULL); // Não permite exclusão se o registro já tiver sido excluído.
			$data = array($this->deleted_field => date('Y-m-d H:i:s')); // Insere o horário da exclusão.
			$this->db->update($this->table, $data);
		}
		return $this->db->affected_rows();
	}
}
