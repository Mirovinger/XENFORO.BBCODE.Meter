<?php namespace CSI\BbCodeMeter\BbCode\Formatter;

/**
 * Class Base
 * @package CSI\BbCodeMeter\BbCode\Formatter
 */
class Base
{
  /**
   * @param array $tag
   * @param array $rendererStates
   * @param \XenForo_BbCode_Formatter_Base $formatter
   * @return mixed
   */
  public static function getBbCodeMeter(array $tag, array $rendererStates, \XenForo_BbCode_Formatter_Base $formatter)
  {
    $xenOptions = \XenForo_Application::get('options');
    $xenVisitor = \XenForo_Visitor::getInstance();
    $tagOption = array_map('trim', explode('|', $tag['option']));

    if (count($tagOption) > 1) {
      $optValue = $tagOption[0];
      $optMin = $tagOption[1];
      $optMax = $tagOption[2];
      $optLow = $tagOption[3];
      $optHigh = $tagOption[4];
    } else {
      $optValue = $tag['option'];
    }

    $tagContent = $formatter->renderSubTree($tag['children'], $rendererStates);
    $view = $formatter->getView();

    if ($view) {
      $template = $view->createTemplateObject('csiXF_bbCode_CC0421BA_tag_meter',
        array(
          'content' => $tagContent,
          'value' => $optValue,
          'min' => $optMin,
          'max' => $optMax,
          'low' => $optLow,
          'high' => $optHigh,
        ));

      $tagContent = $template->render();
      return trim($tagContent);
    }

    return $tagContent;
  }
}
