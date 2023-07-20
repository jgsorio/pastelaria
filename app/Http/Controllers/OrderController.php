<?php

namespace App\Http\Controllers;

use App\DTO\ObjectValue\OrderRequest;
use App\DTO\Orders\OrderRepositoryStoreOrUpdateDTO;
use App\Http\Requests\OrderStoreOrUpdateRequest;
use App\Http\Resources\OrderResource;
use App\Interfaces\ClientRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Mail\SendOrderToMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class OrderController extends Controller
{
    public function __construct(private OrderRepositoryInterface $repository, private ClientRepositoryInterface $clientRepository){}

    public function index(Request $request)
    {
        try {
            $orders = $this->repository->all(json_decode($request->filters) ?? []);
            return OrderResource::collection($orders);
        } catch (Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function store(OrderStoreOrUpdateRequest $request)
    {
        try {
            $order = $this->repository->store(
                new OrderRepositoryStoreOrUpdateDTO(
                    new OrderRequest(
                        clientId: $request->client_id,
                        products: $request->products
                    )
                )
            );
            $client = $this->clientRepository->show($request->client_id);
            Mail::to($client->email)->send(new SendOrderToMail($order));
            return new OrderResource($order);
        } catch (Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function show(string $id)
    {
        try {
            $order = $this->repository->show($id);
            return new OrderResource($order);
        } catch (Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public function update(string $id, OrderStoreOrUpdateRequest $request)
    {
        try {
            $order = $this->repository->update(
                $id,
                new OrderRepositoryStoreOrUpdateDTO(
                    new OrderRequest(
                        clientId: $request->client_id,
                        products: $request->products
                    )
                )
            );

            return new OrderResource($order);
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
