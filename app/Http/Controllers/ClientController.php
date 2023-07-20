<?php

namespace App\Http\Controllers;

use App\DTO\Clients\ClientRepositoryStoreOrUpdateDTO;
use App\Http\Requests\ClientStoreOrUpdateRequest;
use App\Http\Resources\ClientResource;
use App\Interfaces\ClientRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class ClientController extends Controller
{
    public function __construct(private ClientRepositoryInterface $repository){}

    public function store(ClientStoreOrUpdateRequest $request)
    {
        $client = $this->repository->store(
            new ClientRepositoryStoreOrUpdateDTO(
                name: $request->name,
                email: $request->email,
                phone: $request->phone,
                birthdate: $request->birthdate,
                address: $request->address,
                neighborhood: $request->neighborhood,
                zipcode: $request->zipcode,
                complement: $request->complement ?? ''
            )
        );

        return new ClientResource($client);
    }

    public function index(Request $request)
    {
        $clients = $this->repository->all(json_decode($request->filters) ?? []);
        return ClientResource::collection($clients);
    }

    public function show(string $id)
    {
        try {
            $client = $this->repository->show($id);
            return new ClientResource($client);
        } catch (Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
    
    public function update(ClientStoreOrUpdateRequest $request, string $id)
    {
        try {
            $client = $this->repository->update(
                $id,
                new ClientRepositoryStoreOrUpdateDTO(
                    name: $request->name,
                    email: $request->email,
                    phone: $request->phone,
                    birthdate: $request->birthdate,
                    address: $request->address,
                    neighborhood: $request->neighborhood,
                    zipcode: $request->zipcode,
                    complement: $request->complement ?? ''
                )
            );
            return new ClientResource($client);
        } catch (Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->repository->delete($id);
            return response()->json([], 204);
        } catch (Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
        
}
