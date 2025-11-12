<?php
declare(strict_types=1);

namespace Twilio\Http;

final class File {
    /**
     * @var string
     */
    private $fileName;

    /**
     * @var resource|string|mixed|null
     */
    private $contents;

    /**
     * @var string|null
     */
    private $contentType;

    /**
     * @param string $fileName full file path or file name for passed $contents
     * @param string|resource|mixed|null $contents
     * @param ?string $contentType
     */
    public function __construct(string $fileName, $contents = null, ?string $contentType = null) {
        $this->fileName = $fileName;
        $this->contents = $contents;
        $this->contentType = $contentType;
    }

    /**
     * @return resource|string|mixed|null
     */
    public function getContents() {
        return $this->contents;
    }

    public function getFileName(): string {
        return $this->fileName;
    }

    public function getContentType(): ?string {
        return $this->contentType;
    }
}
