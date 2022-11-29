<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBusinessAPIRequest;
use App\Http\Requests\API\UpdateBusinessAPIRequest;
use App\Models\Business;
use App\Repositories\BusinessRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\BusinessResource;
use OpenApi\Annotations as OA;

/**
 * Class BusinessController
 */
class BusinessAPIController extends AppBaseController
{
    /** @var  BusinessRepository */
    private BusinessRepository $businessRepository;

    private const MODEL_NOT_FOUND = 'Business not found';

    public function __construct(BusinessRepository $businessRepo)
    {
        $this->businessRepository = $businessRepo;
    }

    /**
     * @OA\Get(
     *      path="/businesses",
     *      summary="getBusinessList",
     *      tags={"Business"},
     *      description="Get all Businesses",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/Business")
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $businesses = $this->businessRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(BusinessResource::collection($businesses), 'Businesses retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/businesses",
     *      summary="createBusiness",
     *      tags={"Business"},
     *      description="Create Business",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Business")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Business"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBusinessAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $business = $this->businessRepository->create($input);

        return $this->sendResponse(new BusinessResource($business), 'Business saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/businesses/{id}",
     *      summary="getBusinessItem",
     *      tags={"Business"},
     *      description="Get Business",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Business",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Business"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show(int $id): JsonResponse
    {
        /** @var Business $business */
        $business = $this->businessRepository->find($id);

        if (empty($business)) {
            return $this->sendError(self::MODEL_NOT_FOUND);
        }

        return $this->sendResponse(new BusinessResource($business), 'Business retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/businesses/{id}",
     *      summary="updateBusiness",
     *      tags={"Business"},
     *      description="Update Business",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Business",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Business")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Business"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update(int $id, UpdateBusinessAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Business $business */
        $business = $this->businessRepository->find($id);

        if (empty($business)) {
            return $this->sendError(self::MODEL_NOT_FOUND);
        }

        $business = $this->businessRepository->update($input, $id);

        return $this->sendResponse(new BusinessResource($business), 'Business updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/businesses/{id}",
     *      summary="deleteBusiness",
     *      tags={"Business"},
     *      description="Delete Business",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Business",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        /** @var Business $business */
        $business = $this->businessRepository->find($id);

        if (empty($business)) {
            return $this->sendError(self::MODEL_NOT_FOUND);
        }

        $business->delete();

        return $this->sendSuccess('Business deleted successfully');
    }
}
