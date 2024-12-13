<?php

namespace App\Http\Controllers;

use App\DTO\Suppliers\CreateDTO;
use App\DTO\Suppliers\UpdateDTO;
use App\Http\Requests\SupplierStoreRequest;
use App\Http\Requests\SupplierUpdateRequest;
use App\Services\Suppliers\SupplierService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class SuppliersController extends Controller
{
    public function __construct(protected SupplierService $supplierService)
    {}

    /**
     * @OA\Get(
     *     tags={"Suppliers"},
     *     path="/api/v1/suppliers",
     *     summary="Get all suppliers",
     *     description="Gets a list of all suppliers of paginate or with filters.",
     *     @OA\Parameter(
     *         name="orderByDirection",
     *         in="query",
     *         description="Filter suppliers orderBY asc or desc.",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *          name="orderByField",
     *          in="query",
     *          description="Filter suppliers field selected.",
     *          required=false,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *          @OA\Parameter(
     *           name="company",
     *           in="query",
     *           description="Filter suppliers by company.",
     *           required=false,
     *           @OA\Schema(
     *               type="string"
     *           )
     *       ),
     *               @OA\Parameter(
     *            name="cnpjcpf",
     *            in="query",
     *            description="Filter suppliers by cnpjcpf.",
     *            required=false,
     *            @OA\Schema(
     *                type="string"
     *            )
     *        ),
     *                    @OA\Parameter(
     *             name="email",
     *             in="query",
     *             description="Filter suppliers by e-mail.",
     *             required=false,
     *             @OA\Schema(
     *                 type="string"
     *             )
     *         ),
     *                    @OA\Parameter(
     *             name="paginate",
     *             in="query",
     *             description="Informs the number of items per page.",
     *             required=false,
     *             @OA\Schema(
     *                 type="string"
     *             )
     *         ),
     *     @OA\Response(
     *         response=200,
     *         description="List of all locations"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="An error occurred in the listing of the locations."
     *     )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $suppliers = $this->supplierService->all($request);
        return response()->json($suppliers, $suppliers['status']);
    }

    /**
     * @OA\Get(
     *     tags={"Suppliers"},
     *     path="/api/v1/suppliers/{id}",
     *     summary="Get a supplier by id",
     *     description="Get a supplier by id parameter",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of the supplier.",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Supplier info."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No supplier found with the specified id."
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="An error occurred while retrieving the supplier list."
     *     )
     * )
     */
    public function show(int $id): JsonResponse
    {
        $supplier = $this->supplierService->show($id);
        return response()->json($supplier, $supplier['status']);
    }

    /**
     * @OA\Post(
     *     tags={"Suppliers"},
     *     path="/v1/suppliers",
     *     summary="Create new supplier",
     *     description="Create a new supplier",
     *     @OA\Parameter(
     *         name="company",
     *         in="query",
     *         description="Company name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="cnpjcpf",
     *         in="query",
     *         description="CNPJ or CPF",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="phone",
     *         in="query",
     *         description="Supplier phone",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *          @OA\Parameter(
     *          name="email",
     *          in="query",
     *          description="Supplier e-mail",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *          @OA\Parameter(
     *          name="address",
     *          in="query",
     *          description="Supplier address",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(
     *         response=201,
     *         description="Supplier successfully created."
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="The {company, cnpjcpf, phone, email} has already been taken or param is required and unique."
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="An error occurred in the creation of the supplier."
     *     ),
     * )
     */
    public function store(SupplierStoreRequest $request): JsonResponse
    {
        $supplier = $this->supplierService->create(
            CreateDTO::makeFromRequest($request)
        );

        return response()->json($supplier, $supplier['status']);
    }

    /**
     * @OA\Put(
     *     tags={"Suppliers"},
     *     path="/v1/suppliers/{id}",
     *     summary="Update supplier",
     *     description="Update a supplier",
     *          @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Supplier ID",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *         name="company",
     *         in="query",
     *         description="Company name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="cnpjcpf",
     *         in="query",
     *         description="CNPJ or CPF",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="phone",
     *         in="query",
     *         description="Supplier phone",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *          @OA\Parameter(
     *          name="email",
     *          in="query",
     *          description="Supplier e-mail",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *          @OA\Parameter(
     *          name="address",
     *          in="query",
     *          description="Supplier address",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Supplier successfully updated."
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="The {company, cnpjcpf, phone, email} has already been taken or param is required."
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="An error occurred in the creation of the supplier."
     *     ),
     * )
     */
    public function update(SupplierUpdateRequest $request, int $id): JsonResponse
    {
        $supplier = $this->supplierService->update(
            UpdateDTO::makeFromRequest($request),
            $id
        );
        return response()->json($supplier, $supplier['status']);
    }

    /**
     * @OA\Delete(
     *      tags={"Suppliers"},
     *      path="/api/v1/suppliers/{id}",
     *      summary="Delete a supplier by id",
     *      description="Delete a supplier by id parameter",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of the supplier",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="supplier successfully deleted."
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="No supplier found with the specified id."
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="An error occurred in the deleted of the supplier."
     *       ),
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        $supplier = $this->supplierService->destroy($id);
        return response()->json($supplier, $supplier['status']);
    }
}
