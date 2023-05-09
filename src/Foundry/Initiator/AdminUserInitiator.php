<?php

/*
 * This file is part of ShopFixturesPlugin.
 *
 * (c) Akawaka
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Initiator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\UpdaterInterface;
use Sylius\Component\Core\Model\AdminUserInterface;
use Sylius\Component\Core\Model\AvatarImageInterface;
use Sylius\Component\Core\Uploader\ImageUploaderInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\Config\FileLocatorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Webmozart\Assert\Assert;

final class AdminUserInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $adminUserfactory,
        private FactoryInterface $avatarImageFactory,
        private FileLocatorInterface $fileLocator,
        private ImageUploaderInterface $imageUploader,
        private UpdaterInterface $updater,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        $adminUser = $this->adminUserfactory->createNew();
        Assert::isInstanceOf($adminUser, AdminUserInterface::class);

        if ($attributes['api'] ?? null) {
            $adminUser->addRole('ROLE_API_ACCESS');
        }

        $avatar = $attributes['avatar'] ?? null;
        Assert::nullOrString($avatar);

        if (null !== $avatar) {
            $this->createAvatar($adminUser, $avatar);
        }

        unset($attributes['api'], $attributes['avatar']);

        ($this->updater)($adminUser, $attributes);

        return $adminUser;
    }

    private function createAvatar(AdminUserInterface $adminUser, string $avatar): void
    {
        /** @var string $imagePath */
        $imagePath = $this->fileLocator->locate($avatar);
        $uploadedImage = new UploadedFile($imagePath, basename($imagePath));

        /** @var AvatarImageInterface $avatarImage */
        $avatarImage = $this->avatarImageFactory->createNew();

        $avatarImage->setFile($uploadedImage);

        $this->imageUploader->upload($avatarImage);

        $adminUser->setAvatar($avatarImage);
    }
}
