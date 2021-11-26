<?php

namespace App\Services;

use App\Models\Branch;

class BranchService
{
	private $branch;

	public function __construct()
	{
		$this->branch = new Branch();
	}

	public function list()
	{
		$branches = $this->branch->where('parent_id', 0)->where('status', '<>', 2)->orderBy('id', 'desc')->get();
		$count = 0;
		$resultBranches = [];
		foreach($branches as  $branch)
		{
			$childrenBranches = $branch->children()->select('branch.*', 'branch.name as branch_name')->selectRaw('(SELECT name FROM branch b WHERE b.id=branch.parent_id) as department_name')->where('status', 1)->get();
			
			$resultBranches[$count] = $branch;
			$resultBranches[$count]['department_name'] = $branch->name;
			foreach($childrenBranches as $childrenBranch)
			{
				++$count;
				$resultBranches[$count] = $childrenBranch;
			}
			++$count;
		}

		return $resultBranches;
	}

	public function activeBranches()
	{
		return $this->branch->where('status', 1)->orderBy('id', 'desc')->get();
	}

	public function branchesByParentId($parentId)
	{
		return $this->branch->where('parent_id', $parentId)->where('status', 1)->orderBy('id', 'desc')->get();
	}

	public function branchById($id)
	{
		return $this->branch->where('id', $id)->first();
	}

	public function branchByName($name)
	{
		return $this->branch->where('name', $name)->first();
	}

	public function store($data)
	{
		$request = [
			'parent_id' => $data['parent_id'],
			'curation' => $data['curation'],
			'name' => $data['name'],
			'status' => $data['status']
		];
		$branch = $this->branch->create($request);
		return $branch->id;
	}

	public function update($id, $data)
	{
		$request = [
			'parent_id' => $data['parent_id'],
			'curation' => $data['curation'],
			'name' => $data['name'],
			'status' => $data['status']
		];
		return $this->branch->where('id', $id)
   				     			  ->update($request);
	}

	public function delete($id, $data)
	{
		$request = [
			'status' => $data['status']
		];
		return $this->branch->where('id', $id)
   				     			  ->update($request);
	}
}
